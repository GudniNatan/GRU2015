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
    public partial class Form1 : Form
    {
        /*
         * Guðni Natan Gunnarsson, Jóhann Rúnarsson
         * Nóvember 2015
         */
        
        
        Gagnagrunnur gagnagrunnur = new Gagnagrunnur();
       
        public Form1()
        {
            InitializeComponent();
        }
        private void Form1_Load(object sender, EventArgs e)
        {
            try
            {
                gagnagrunnur.TengingVidGagnagrunn();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.ToString());
            }
        }

        private void bt_innskra_Click(object sender, EventArgs e)
        {
            string kt = tb_kennitala.Text;
            if (gagnagrunnur.OpenConnection() == true)
            {
                gagnagrunnur.CloseConnection();

            }
            if (gagnagrunnur.Kennitolutekk(kt))
            {
                if (gagnagrunnur.IsAdmin(kt))
                {
                    login();
                }
                else
                {
                    MessageBox.Show("Ekki admin");
                }
            }
            else
            {
                MessageBox.Show("Kennitala röng");
                if (gagnagrunnur.IsAdmin(kt))
                {
                    login();
                }
                else
                {
                    MessageBox.Show("Ekki admin");
                }
            }
            
                    
        }
        private void login()
        {
            string kt = tb_kennitala.Text;
            string pw = tb_lykilord.Text;
            Form2 form2 = new Form2();

            if (gagnagrunnur.Login(kt, pw))
            {
                form2.Form2Load(kt, pw);
                form2.Show();
            }
            else
            {
                MessageBox.Show("Rangt lykilorð");
            }
            
        }

        
    }
}
