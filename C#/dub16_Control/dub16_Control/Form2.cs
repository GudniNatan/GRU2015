﻿using System;
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
        /* TODO
         * Breyta töflu (allt)
         * Bæta við (allt)
         * Ekki á að vera hægt að eyða út atburði ef einhver er meðlimur er skráður á hann
         * Ekki á að vera hægt að eyða út meðlimi ef hann er skráður á atburð
         * Nöfn á textboxum og tökkum
         */
        Gagnagrunnur gagnagrunnur = new Gagnagrunnur();
        string notandi;
        string tabpage = "Medlimur";

        public Form2()
        {
            InitializeComponent();
            try
            {
                gagnagrunnur.TengingVidGagnagrunn();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.ToString());
            }
        }
        public void Form2Load(string kt) //Þegar Form2 er sýnt
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
            List<string> gogn = new List<string>();
            TabPage current = (sender as TabControl).SelectedTab;
            tabpage = current.Text;

            // Hreinsa ListView
            listView1.Clear();
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
        private void FyllaListView(string tafla)
        {
            /*Þetta er listinn sem lesinn er upp úr gagnagrunninum*/
            List<string> linur = new List<string>();

            /*Þetta heldur utam um itemin sem eru bætt við í hverja línu í listviewinu*/
            ListViewItem itm;


            try
            {
                linur = gagnagrunnur.LesaUrSqlToflu(tafla);

                foreach (string lin in linur)
                {
                    string[] linaUrLista = lin.Split('|');

                    string[] arr = new string[linaUrLista.Length - 1];


                    for (int i = 0; i < linaUrLista.Length - 1; i++)
                    {
                        arr[i] = linaUrLista[i];
                    }

                    itm = new ListViewItem(arr);
                    listView1.Items.Add(itm);
                }
            }
            catch (Exception ex)
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
                listView1.Items.Clear();
                FyllaListView(tabpage);
            }
            catch (Exception ex)
            {
                MessageBox.Show("Gat ekki eytt: " + ex);
            }
            
        }
        private void listView1_ItemSelectionChanged(object sender, ListViewItemSelectionChangedEventArgs e)
        {
            List<string> lin = gagnagrunnur.LesaUrSqlToflu(tabpage);
            string[] items = lin[0].Split('|');
            switch (tabpage)
            {
                case "Medlimur":
                    tb_breytaMedlimID.Text = items[0];
                    tb_breytaMedlimNafn.Text = items[1];
                    tb_breytaMedlimKennitala.Text = items[2];
                    tb_breytaMedlimSimi.Text = items[3];
                    break;
                case "Vidburdur":
                    tb_breytaVidburdiID.Text = items[0];
                    tb_breytaVidburdiHeiti.Text = items[1];
                    tb_breytaVidburdiDagsetning.Text = items[2];
                    break;
                case "Skraning":
                    tb_breytaSkraninguID.Text = items[0];
                    tb_breytaSkraninguVidburdurID.Text = items[1];
                    tb_breytaSkraninguMedlimurID.Text = items[2];
                    break;
                case "Admin":
                    tb_breytaAdminID.Text = items[0];
                    tb_breytaAdminMedlimurID.Text = items[1];
                    break;
                default:
                    MessageBox.Show("Villa");
                    break;
            }
        }

        private void bt_nyrMedlimur_Click(object sender, EventArgs e)
        {
            string nafn = tb_nyrMedlimurNafn.Text;
            string kt = tb_nyrMedlimurKennitala.Text;
            string simi = tb_nyrMedlimurSimi.Text;
            try
            {
                gagnagrunnur.NyrMedlimur(nafn, kt, simi);
                
            }
            catch (Exception ex)
            {

                MessageBox.Show(ex.ToString());
            }
        }

    }
}
