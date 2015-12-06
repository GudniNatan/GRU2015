using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace dub16_Control
{
    public partial class Form2 : Form
    {
        Gagnagrunnur gagnagrunnur = new Gagnagrunnur(); //Nota gagnagrunnur.cs
        string notandi;     //Kennitala hjá notanda
        public string ummaeli;
        public string ummaeliSott;
        string tabpage = "Medlimur";    //Tabpage er notað til að geyma nafnið á töflunni sem verið er að skoða, forritið opnar á Medlimur töflunni

        public Form2()      //On load
        {
            InitializeComponent();
            try
            {
                gagnagrunnur.TengingVidGagnagrunn();    //Opnar tengingu við gagnagrunn
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.ToString());
            }
        }
        public void Form2Load(string kt, string pw) //Þegar Form2 er sýnt
        {
            notandi = kt;
            lb_notandi.Text = "Notandi: " + kt;



            /*Þetta eru dálkarnir sem eru efst í listViewinu*/
            listView1.Columns.Add("ID", 60);
            listView1.Columns.Add("Nafn", 150);
            listView1.Columns.Add("kennitala", 80);
            listView1.Columns.Add("sími", 80);

            FyllaListView("Medlimur");
        }
        void tabControl1_Selecting(object sender, TabControlCancelEventArgs e)
        {
            List<string> gogn = new List<string>();//Býr til list
            TabPage current = (sender as TabControl).SelectedTab;
            tabpage = current.Text;

            // Hreinsa ListView
            listView1.Clear();//hreinsir listview
            switch (tabpage)
            {
                case "Medlimur":
                    /*Þetta eru dálkarnir sem eru efst í listViewinu*/
                    listView1.Columns.Add("ID", 60);
                    listView1.Columns.Add("Nafn", 150);
                    listView1.Columns.Add("kennitala", 80);
                    listView1.Columns.Add("sími", 80);

                    FyllaListView("Medlimur");
                    break;
                case "Vidburdur":

                    listView1.Columns.Add("ID", 60);
                    listView1.Columns.Add("Heiti", 150);
                    listView1.Columns.Add("Dagsetning", 150);

                    FyllaListView("Vidburdur");
                    break;
                case "Skraning":

                    listView1.Columns.Add("ID", 60);
                    listView1.Columns.Add("vidburdur_id", 60);
                    listView1.Columns.Add("medlimur_id", 60);

                    FyllaListView("Skraning");
                    break;
                case "Admin":

                    listView1.Columns.Add("ID", 60);
                    listView1.Columns.Add("medlimur_ID", 60);

                    FyllaListView("Admin");
                    break;
                default:
                    MessageBox.Show("Villa");
                    break;
            }
        }
        private void listView1_ItemSelectionChanged(object sender, ListViewItemSelectionChangedEventArgs e)
        {
            List<string> lin = gagnagrunnur.LesaUrSqlToflu(tabpage);
            string[] items = lin[0].Split('|');
            if (listView1.SelectedIndices.Count <= 0)
            {
                return;
            }
            int intSelectIndex = listView1.SelectedIndices[0];
            if (intSelectIndex >= 0)
            {
                switch (tabpage)
                {
                    case "Medlimur":
                        tb_breytaMedlimID.Enabled = false;
                        tb_breytaMedlimID.Text = listView1.SelectedItems[0].SubItems[0].Text;
                        tb_breytaMedlimNafn.Text = listView1.SelectedItems[0].SubItems[1].Text;
                        tb_breytaMedlimKennitala.Text = listView1.SelectedItems[0].SubItems[2].Text;
                        tb_breytaMedlimSimi.Text = listView1.SelectedItems[0].SubItems[3].Text;
                        break;
                    case "Vidburdur":
                        tb_breytaVidburdiID.Enabled = false;
                        tb_breytaVidburdiID.Text = listView1.SelectedItems[0].SubItems[0].Text;
                        tb_breytaVidburdiHeiti.Text = listView1.SelectedItems[0].SubItems[1].Text;
                        tb_breytaVidburdiMyndURL.Text = listView1.SelectedItems[0].SubItems[4].Text;

                        string datetime = listView1.SelectedItems[0].SubItems[2].Text.Split(' ')[0];

                        DateTime myDate = DateTime.ParseExact(datetime, "M/d/yyyy",
                                       System.Globalization.CultureInfo.InvariantCulture);

                        string date = myDate.ToString("yyyy-MM-dd");
                        ummaeliSott  = listView1.SelectedItems[0].SubItems[3].Text;

                        tb_breytaVidburdiDagsetning.Text = date;
                        break;
                    case "Skraning":
                        tb_breytaSkraninguID.Enabled = false;
                        tb_breytaSkraninguID.Text = listView1.SelectedItems[0].SubItems[0].Text;
                        tb_breytaSkraninguVidburdurID.Text = listView1.SelectedItems[0].SubItems[1].Text;
                        tb_breytaSkraninguMedlimurID.Text = listView1.SelectedItems[0].SubItems[2].Text;
                        break;
                    case "Admin":
                        tb_breytaAdminID.Enabled = false;
                        tb_breytaAdminID.Text = listView1.SelectedItems[0].SubItems[0].Text;
                        tb_breytaAdminMedlimurID.Text = listView1.SelectedItems[0].SubItems[1].Text;
                        break;
                    default:
                        MessageBox.Show("Villa");
                        break;
                }
            }
        }
        private void FyllaListView(string tafla)
        {
            /*Þetta er listinn sem lesinn er upp úr gagnagrunninum*/
            List<string> linur = new List<string>();

            /*Þetta heldur utam um itemin sem eru bætt við í hverja línu í listviewinu*/
            ListViewItem itm;


            try//prufa
            {
                linur = gagnagrunnur.LesaUrSqlToflu(tafla);

                foreach (string lin in linur)
                {
                    string[] linaUrLista = lin.Split('|');

                    string[] arr = new string[linaUrLista.Length - 1];


                    for (int i = 0; i < linaUrLista.Length - 1; i++)//for liggja ef i er minni en linaurlista -1
                    {
                        arr[i] = linaUrLista[i];
                    }

                    itm = new ListViewItem(arr);
                    listView1.Items.Add(itm);
                }
            }
            catch (Exception ex)//skilar villunar
            {
                MessageBox.Show(ex.ToString());
                throw;
            }
        }

        private void bt_eyda_Click(object sender, EventArgs e)
        {
            try
            {
                string id = tb_eydaID.Text;
                gagnagrunnur.Eyda(tabpage, id);
                
                
            }
            catch (Exception ex)
            {
                MessageBox.Show("Gat ekki eytt: " + ex);
            }
            Refresh(tabpage);

        }


        private void bt_nyrMedlimur_Click(object sender, EventArgs e)   //Nýr meðlimur
        {
                                   
            string nafn = tb_nyrMedlimurNafn.Text;  //Sækir breytur úr textadálkum
            string kt = tb_nyrMedlimurKennitala.Text;
            string simi = tb_nyrMedlimurSimi.Text;
            string lykilord = tb_nyrMedlimurLykilord.Text;
            try
            {
                gagnagrunnur.NyrMedlimur(nafn, kt, simi, lykilord); //Notar NyrMedlimur úr gagnagrunnur.cs til að gera nýjann meðlim

            }
            catch (Exception ex)    //Ef eitthvað fer úrskeiðis
            {

                MessageBox.Show(ex.ToString());
            }
            Refresh(tabpage);   //Refresh-ar töfluna til að sýna nýja meðliminn
        }

        private void bt_refresh_Click(object sender, EventArgs e)
        {
            Refresh(tabpage);   //Refresh-ar töfluna sem verið er að skoða
        }

        private void Refresh(string tafla)  //Til að refresh-a töfluna
        {
            listView1.Items.Clear();        //Hreinsar listview-ið
            List<string> linur = new List<string>();
            try
            {
                FyllaListView(tafla);   //Fyllir listview
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.ToString());

            }
        }

        private void bt_breytaMedlim_Click(object sender, EventArgs e)
        {
            string id = tb_breytaMedlimID.Text;    //Sækir breytur úr textaboxum
            string nafn = tb_breytaMedlimNafn.Text;
            string kt = tb_breytaMedlimKennitala.Text;
            string simi = tb_breytaMedlimSimi.Text;
            string lykilord = tb_breytaMedlimLykilord.Text;
            try
            {
                gagnagrunnur.UppfaeraMedlimur(id, nafn, kt, simi, lykilord);    //Notar UppfaeraMedlimur úr gagnagrunnur.cs
            }
            catch (Exception ex)
            {

                MessageBox.Show(ex.ToString());
            }
            Refresh(tabpage);   //Refresh til að sýna breytingar
        }

        private void bt_nySkraning_Click(object sender, EventArgs e)
        {
            int medlimur = Convert.ToInt32(tb_nySkraningMedlimurID.Text);   //Sæki breytur úr textaboxum
            int vidburdur = Convert.ToInt32(tb_nySkraningVidburdurID.Text);
            try
            {
                gagnagrunnur.NySkraning(vidburdur, medlimur);   //Notar NySkraning úr gagnagrunnur.cs til að skrá meðlim á viðburð
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.ToString());
            }
            Refresh(tabpage);   //Refresh til að sýna breytingar

        }

        private void bt_breytaVidburdi_Click(object sender, EventArgs e)
        {
            string id = tb_breytaVidburdiID.Text;   //Sækir breytur úr textaboxum
            string nafn = tb_breytaVidburdiHeiti.Text;
            string date = tb_breytaVidburdiDagsetning.Text;
            string myndURL = tb_breytaVidburdiMyndURL.Text;
            if (date[4] == '-' && date[7] == '-' && date.Length == 10)  //Til að vera viss um að dagsetning sé á réttu formi
            {
                try
                {
                    gagnagrunnur.UppfaeraVidburdur(id, nafn, date, ummaeli, myndURL);   //Notar NySkraning úr gagnagrunnur.cs til að skrá meðlim á viðburð
                }
                catch (Exception ex)
                {

                    MessageBox.Show(ex.ToString());
                }
                Refresh(tabpage);
            }
            else
            {
                MessageBox.Show("Dagsetning ekki rétt. Dagsetning á að vera á forminu ÁÁÁÁ-MM-DD");
            }
        }

        private void bt_nyrVidburdur_Click(object sender, EventArgs e)
        {
            string nafn = tb_nyrVidburdurHeiti.Text;
            string myndURL = tb_nyrVidburdurMyndURL.Text;
            string date = tb_nyrVidburdurDagsetning.Text;
            if (date.Length == 10 && date[4] == '-' && date[7] == '-')
            {
                try
                {
                    gagnagrunnur.NyrVidburdur(nafn, date, ummaeli, myndURL);
                }
                catch (Exception ex)
                {
                    MessageBox.Show(ex.ToString());
                }
                ummaeli = null;
                Refresh(tabpage);
            }
            else
            {
                MessageBox.Show("Dagsetning ekki rétt. Dagsetning á að vera á forminu ÁÁÁÁ-MM-DD");
            }
        }

        private void bt_nyrAdmin_Click(object sender, EventArgs e)
        {
            string id = tb_nyrAdminMedlimurID.Text;

            try
            {
                gagnagrunnur.NyAdmin(id);
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.ToString());
                
            }
            

            Refresh(tabpage);
        }

        private void bt_breytaAdmin_Click(object sender, EventArgs e)
        {
            string id = tb_breytaAdminID.Text;
            string med_id = tb_breytaAdminMedlimurID.Text;

            try
            {
                gagnagrunnur.UpfaeraAdmin(id, med_id);
            }
            catch (Exception ex)
            {

                MessageBox.Show(ex.ToString());
            }
            Refresh(tabpage);
        }

        private void bt_breytaSkraningu_Click(object sender, EventArgs e)
        {
            string id = tb_breytaSkraninguID.Text;
            string vid_id = tb_breytaSkraninguVidburdurID.Text;
            string med_id = tb_breytaSkraninguMedlimurID.Text;
            try//prufa
            {
                gagnagrunnur.UpfaeraSkraning(id, vid_id, med_id);
            }
            catch (Exception ex)//skilar
            {
                MessageBox.Show(ex.ToString());
                
            }
            Refresh(tabpage);
        }
         
        private void bt_ummaeli_Click(object sender, EventArgs e)
        {
            using (Ummaeli umform = new Ummaeli())
            {
                umform.GetUmmaeli(ummaeli);
                if (umform.ShowDialog() == DialogResult.OK)
                {
                    ummaeli = umform.TheValue;
                }
            }
        }

        private void bt_breytaUmmaeli_Click(object sender, EventArgs e)
        {
            ummaeli = ummaeliSott;
            using (Ummaeli umform = new Ummaeli())
            {
                umform.GetUmmaeli(ummaeli);
                if (umform.ShowDialog() == DialogResult.OK)
                {
                    ummaeli = umform.TheValue;
                }
            }
        }
    }
}

