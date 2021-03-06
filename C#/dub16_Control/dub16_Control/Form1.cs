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
            //checkar ef það virkar að tengja gagnagrunnin
            try
            {
                gagnagrunnur.TengingVidGagnagrunn();
            }
            catch (Exception ex)//Skíla villunar ef það virkar ekki
            {
                MessageBox.Show(ex.ToString());
            }
        }

        private void bt_innskra_Click(object sender, EventArgs e)
        {
            pictureBoxLoadIcon.Visible = true;
            string kt = tb_kennitala.Text;
            //ef gagna grunnur er opið
            if (gagnagrunnur.OpenConnection() == true)
            {
                gagnagrunnur.CloseConnection();

            }
            if (gagnagrunnur.Kennitolutekk(kt))//ef þetta er kennitala
            {
                if (gagnagrunnur.IsAdmin(kt))//ef þetta er admin
                {
                    login();//opnar klassin Login
                }
                else//annars ekki
                {
                    MessageBox.Show("Ekki admin");
                }
            }
            else//annars ekki
            {
                MessageBox.Show("Kennitala röng");
                if (gagnagrunnur.IsAdmin(kt))//ef þeta er admin 
                {
                    
                    login();//opnar klassin login
                    
                }
                else//anarst ekki  
                {
                    MessageBox.Show("Ekki admin");
                }
            }
            tb_lykilord.Text = null;
            tb_kennitala.Text = null;
            pictureBoxLoadIcon.Visible = false;
                    
        }
        private void login()//
        {
            string kt = tb_kennitala.Text;
            string pw = tb_lykilord.Text;
            Form2 form2 = new Form2();//Búa til Form2

            if (gagnagrunnur.Login(kt, pw))//ef bæði kennitala og password er rétt
            {
                form2.Form2Load(kt, pw);//loada form 2
                form2.Show();//sýna form2

                
            }
            else//annars
            {
                MessageBox.Show("Rangt lykilorð");
            }
            
        }

        
    }
}
