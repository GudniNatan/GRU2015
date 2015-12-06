using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MySql.Data.MySqlClient;
using System.Security.Cryptography;
using CryptSharp;

namespace dub16_Control
{
    class Gagnagrunnur
    {
        private string server;
        private string database;
        private string uid;
        private string password;
        string tengistrengur = null;
        string fyrirspurn = null;

        public MySqlConnection sqltenging;
        MySqlCommand nySQLskipun;
        MySqlDataReader sqllesari = null;

        public void TengingVidGagnagrunn()
        {
            server = "82.148.66.15";
            database = "GRU_H6_dub16";
            uid = "GRU_H6";
            password = "mypassword";

            tengistrengur = "server=" + server + ";userid=" + uid + ";password=" + password + ";database=" + database;

            sqltenging = new MySqlConnection(tengistrengur);
        }
        public bool Login(string notandi, string lykilord)
        {
            try
            {
                string command = "SELECT kennitala, lykilord FROM medlimur WHERE kennitala = @notandi";
                // CONNECTION DETAILS
                sqltenging.Open();

                // COMMAND DETAILS
                nySQLskipun = new MySqlCommand(command, sqltenging);

                // PARAMETERS
                nySQLskipun.Parameters.AddWithValue("@notandi", notandi);

                // CHECK DETAILS               
                sqllesari = nySQLskipun.ExecuteReader();
                if (!sqllesari.Read())
                {
                    //No user found
                    MessageBox.Show("Röng kennitala");
                }
                else
                {
                    string dbPassword = sqllesari.GetString(1);
                    if (ValidateUser(lykilord, dbPassword))
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
                sqllesari.Close();

            }
            catch (MySqlException ex)
            {
                MessageBox.Show("MySQL Error - Code AHx004: " + ex.Message);
                sqltenging.Close();
            }
            return false;
        }
        public bool ValidateUser(string submittedPassword, string passwordFromDB)
        {
            return Crypter.CheckPassword(submittedPassword, passwordFromDB);
        }
        public void SettInnSqlToflu(string notandi, string heiti)
        {
            if (OpenConnection() == true)//ef tenging er opið
            {
                fyrirspurn = "INSERT INTO " + notandi + " (heiti) VALUES ('" + heiti + "')";//set nýr töfluna inná sql
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }

        }
        public void Uppfaera(string notandi, string id, string heiti)
        {
            if (OpenConnection() == true)//ef tenging er opið
            {
                fyrirspurn = "UPDATE " + notandi + " SET heiti ='" + heiti + "' WHERE id = '" + id + "'";//breytt töfluna inná sql
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }
        }
        public void NyrMedlimur(string nafn, string kt, string simi, string lykilord)
        {
            int cost = 10;
            string salt = BlowfishCrypter.Blowfish.GenerateSalt(cost);
            string hash = BlowfishCrypter.Blowfish.Crypt(lykilord, salt);

            if (OpenConnection() == true)//ef tenging er opið
            {
                fyrirspurn = "INSERT INTO Medlimur (nafn, kennitala, simi, lykilord) VALUES ('" + nafn + "','" + kt + "','" + simi + "', '" + hash + "')";//set nýr töfluna inná sql
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }

        }
        public string TrimKennitala(string kennitala)
        {
            kennitala = kennitala.Trim();
            int i = kennitala.IndexOf('-');
            while (i > 0)
            {
                kennitala.Remove(i, 1);
                i = kennitala.IndexOf('-');
            }
            return kennitala;
        }
        public void Eyda(string tafla, string id)
        {
            if (OpenConnection() == true)//ef tenging er opið
            {
                try//prufa
                {
                    fyrirspurn = "DELETE FROM " + tafla + " where id ='" + id + "'";//eyða töfluna inná sql
                    nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                    nySQLskipun.ExecuteNonQuery();
                    CloseConnection();
                }
                catch (MySqlException)//skilar villunar
                {
                    MessageBox.Show("Ekki er hægt að eyða úr " + tafla + "töflu ef notandi er skráður á viðburð");
                    CloseConnection();
                }
            }
        }

        public bool OpenConnection()
        {
            try//ðrufa
            {
                if (sqltenging.State != ConnectionState.Open)
                {
                    sqltenging.Open();
                }
                
                return true;
            }
            catch (MySqlException ex)//skilar villunar
            {
                throw ex;
            }
        }
        public bool CloseConnection()
        {
            try//prufa
            {
                sqltenging.Close();
                return true;
            }
            catch (MySqlException ex)//skilar villuna
            {
                throw ex;
            }
        }
        public List<string> LesaUrSqlToflu(string tafla)
        {
            List<string> faerslur = new List<string>();//byr til list
            string line = null;
            if (OpenConnection() == true)//ef tenging er opið
            {
                fyrirspurn = "SELECT * FROM " + tafla;//leita á töflur inná sql
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    for (int i = 0; i < sqllesari.FieldCount; i++)
                    {
                        line += (sqllesari.GetValue(i).ToString()) + "|";
                    }
                    faerslur.Add(line);
                    line = null;
                }
                CloseConnection();//loka tenging
                return faerslur;

            }
            return faerslur;
        }
        public string[] FinnaAkvedinnOgSkilaTilBaka(string id)
        {
            string[] gogn = new string[4];
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT id_medlimur, nafn, netfang, simanumer FROM medlimur WHERE id_medlimur = '" + id + "'";//leita inná sql töflur
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    gogn[0] = sqllesari.GetValue(0).ToString();
                    gogn[1] = sqllesari.GetValue(1).ToString();
                    gogn[2] = sqllesari.GetValue(2).ToString();
                    gogn[3] = sqllesari.GetValue(3).ToString();
                }
                sqllesari.Close();
                CloseConnection();
                return gogn;

            }
            return gogn;
        }
        public string FinnaEinstakling(string id)
        {
            string lina = null;
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT id_medlimur,nafn,netfang,simanumer FROM medlimur where id_medlimur='" + id + "'";//leitar inná sql töflur
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    for (int i = 0; i < sqllesari.FieldCount; i++)
                    {
                        lina += (sqllesari.GetValue(i).ToString()) + "|";
                    }
                }
                sqltenging.Close();
            }
            return lina;
        }
        public bool Kennitolutekk(string kennitala)
        {
            kennitala = kennitala.Trim();
            int i = kennitala.IndexOf('-');
            while (i > 0)
            {
                kennitala.Remove(i, 1);
                i = kennitala.IndexOf('-');
            }
            if (kennitala.Length == 10)
            {
                int iSum = (int.Parse(kennitala[0].ToString()) * 3) +
                            (int.Parse(kennitala[1].ToString()) * 2) +
                            (int.Parse(kennitala[2].ToString()) * 7) +
                            (int.Parse(kennitala[3].ToString()) * 6) +
                            (int.Parse(kennitala[4].ToString()) * 5) +
                            (int.Parse(kennitala[5].ToString()) * 4) +
                            (int.Parse(kennitala[6].ToString()) * 3) +
                            (int.Parse(kennitala[7].ToString()) * 2);
                int iSum_t = 0;
                if (iSum % 11 > 0)
                {
                    iSum_t = (iSum / 11) + 1;
                }
                else
                {
                    iSum_t = iSum / 11;
                }
                if ((iSum_t * 11) - iSum == int.Parse(kennitala[8].ToString()))
                {
                    return true;
                }
            }
            return false;
        }
        public bool IsAdmin(string kennitala)
        {
            string lina = null;
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT Admin.ID  FROM ADMIN INNER JOIN Medlimur ON Admin.medlimur_id = Medlimur.ID WHERE Medlimur.Kennitala = '" + kennitala + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    for (int i = 0; i < sqllesari.FieldCount; i++)
                    {
                        lina += (sqllesari.GetValue(i).ToString()) + "|";
                    }
                }
                sqltenging.Close();
                if (lina == string.Empty || lina == null)
                {
                    return false;
                }
                else
                {

                    return true;
                }
            }
            return false;
        }
        public void NyAdmin(string id)
        {
            if (OpenConnection() == true)
            {
                fyrirspurn = "INSERT INTO Admin (medlimur_ID) VALUES ('" + id + "')";//sett iná sql töflur
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }

        }
        public void NySkraning(int vid_id, int med_id)
        {
            string lina = null;
            string lina2 = null;
            int vidID = vid_id;
            int medID = med_id;
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT Medlimur.ID FROM Medlimur where Medlimur.ID = '" + medID + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    for (int i = 0; i < sqllesari.FieldCount; i++)
                    {
                        lina += (sqllesari.GetValue(i).ToString()) + "|";
                    }
                }
                sqltenging.Close();
            }
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT Vidburdur.ID FROM Vidburdur where Vidburdur.ID = '" + vidID + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    for (int i = 0; i < sqllesari.FieldCount; i++)
                    {
                        lina2 += (sqllesari.GetValue(i).ToString()) + "|";
                    }
                }
                sqltenging.Close();
            }
            if (OpenConnection() == true)
            {
                if (lina == string.Empty || lina == null || lina2 == string.Empty || lina2 == null)
                {
                    MessageBox.Show("Þetta er Ekki til A: " + lina +" B: " + lina2);//þetta er false
                }
                else
                {
                    fyrirspurn = "INSERT INTO Skraning (vidburdur_id, medlimur_id) VALUES ('" + vidID + "','" + medID + "')";//sett iná sql töflur
                    nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                    nySQLskipun.ExecuteNonQuery();
                    CloseConnection();             
                }
                sqltenging.Close();
            }
         }
        public void UppfaeraMedlimur(string id, string nafn, string kt, string simi, string lykilord)
        {
            int cost = 10;
            string salt = BlowfishCrypter.Blowfish.GenerateSalt(cost);
            string hash = BlowfishCrypter.Blowfish.Crypt(lykilord, salt);

            if (OpenConnection() == true)
            {
                fyrirspurn = "Update medlimur set id = '" + id +
                "', nafn='" + nafn + "',kennitala='" + kt + "',simi='" +
                simi + "', lykilord ='" + hash + "' where id='" + id+ "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }

         }
        public void UppfaeraVidburdur(string id, string nafn, string dagsetning, string ummaeli, string myndURL)
        {
            if (OpenConnection() == true)
            {
                fyrirspurn = "Update vidburdur set id = '" + id +
                    "', heiti='" + nafn + "',dagsetning='" + dagsetning + "', ummaeli = '" + ummaeli + "', myndURL = '" + myndURL+ "' where id='" + id + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }

        }
        public void NyrVidburdur(string nafn, string date, string ummaeli, string myndURL)
        {
            if (OpenConnection() == true)
            {
                fyrirspurn = "INSERT INTO Vidburdur (heiti, dagsetning, ummaeli, myndURL) VALUES ('" + nafn + "','" + date + "', '" + ummaeli + "', '" + myndURL + "')";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }

        }
        public void UpfaeraAdmin(string id,string med_id)
        {
            if (OpenConnection() == true)
            {
                fyrirspurn = "Update admin set id = '" + id +
                    "', medlimur_id='" + med_id+ "' where id='" + id + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }
        }
        public void UpfaeraSkraning(string id, string vid_id, string med_id)
        {
            if (OpenConnection() == true)
            {
                fyrirspurn = "Update skraning set id = '" + id +
                   "', vidburdur_id='" + vid_id + "', medlimur_id='" + med_id + "' where id='" + id + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }

        }

    }
}

