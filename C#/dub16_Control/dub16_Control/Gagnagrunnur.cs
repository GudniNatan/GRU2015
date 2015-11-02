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


namespace dub16_Control
{
    class Gagnagrunnur
    {
        private string server;
        private string database;
        private string uid;
        private string password;
        public string user;
        string tengistrengur = null;
        string fyrirspurn = null;

        MySqlConnection sqltenging;
        MySqlCommand nySQLskipun;
        MySqlDataReader sqllesari = null;

        public void TengingVidGagnagrunn()
        {
            server = "tsuts.tskoli.is";
            database = "1803982879_dub16";
            uid = "1803982879";
            password = "mypassword";

            tengistrengur = "server=" + server + ";userid=" + uid + ";password=" + password + ";database=" + database;

            sqltenging = new MySqlConnection(tengistrengur);
        }
        public void SettInnSqlToflu(string notandi, string heiti)
        {
            if (OpenConnection() == true)
            {
                fyrirspurn = "INSERT INTO " + notandi + " (heiti) VALUES ('" + heiti + "')";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }

        }
        public void Uppfaera(string notandi, string id, string heiti)
        {
            if (OpenConnection() == true)
            {
                fyrirspurn = "UPDATE " + notandi + " SET heiti ='" + heiti + "' WHERE id = '" + id + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }
        }
        public void UppfaeraMedlimur(string id, string kt, string nafn, string net, string simi)
        {
            if (OpenConnection() == true)
            {
                fyrirspurn = "UPDATE medlimur SET id_medlimur ='" + kt + "', nafn ='" + nafn + "', netfang ='" + net + "', simanumer = '" + simi + "' WHERE id_medlimur = '" + id + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }
        }
        public void NyrMedlimurTafla(string kt)
        {
            kt = TrimKennitala(kt);
            if (OpenConnection() == true)
            {
                fyrirspurn = "DROP TABLE IF EXISTS _" + kt + "; CREATE TABLE _" + kt + "(ID INT PRIMARY KEY NOT NULL auto_increment, heiti VARCHAR(255));";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }
        }
        public void NyrMedlimur(string kt, string nafn, string netfang, string simi)
        {
            if (OpenConnection() == true)
            {
                fyrirspurn = "INSERT INTO medlimur (id_medlimur, nafn, netfang, simanumer) VALUES ('" + kt + "','" + nafn + "','" + netfang + "','" + simi + "')";
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
            if (OpenConnection() == true)
            {
                fyrirspurn = "DELETE FROM " + tafla + " where id ='" + id + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                nySQLskipun.ExecuteNonQuery();
                CloseConnection();
            }
        }

        private bool OpenConnection()
        {
            try
            {
                sqltenging.Open();
                return true;
            }
            catch (MySqlException ex)
            {
                throw ex;
            }
        }
        private bool CloseConnection()
        {
            try
            {
                sqltenging.Close();
                return true;
            }
            catch (MySqlException ex)
            {
                throw ex;
            }
        }
        public List<string> LesaUrSqlToflu(string tafla)
        {
            List<string> faerslur = new List<string>();
            string line = null;
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT * FROM " + tafla;
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
                CloseConnection();
                return faerslur;

            }
            return faerslur;
        }
        public string[] FinnaAkvedinnOgSkilaTilBaka(string id)
        {
            string[] gogn = new string[4];
            if (OpenConnection() == true)
            {
                fyrirspurn = "SELECT id_medlimur, nafn, netfang, simanumer FROM medlimur WHERE id_medlimur = '" + id + "'";
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
                fyrirspurn = "SELECT id_medlimur,nafn,netfang,simanumer FROM medlimur where id_medlimur='" + id + "'";
                nySQLskipun = new MySqlCommand(fyrirspurn, sqltenging);
                sqllesari = nySQLskipun.ExecuteReader();
                while (sqllesari.Read())
                {
                    for (int i = 0; i < sqllesari.FieldCount; i++)
                    {
                        lina += (sqllesari.GetValue(i).ToString()) + ":";
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
                        lina += (sqllesari.GetValue(i).ToString()) + ":";
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

    }
}

