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
    public partial class Ummaeli : Form
    {
        public Ummaeli()
        {
            InitializeComponent();
        }
        Form2 form2 = new Form2();

        private void bt_submit_Click(object sender, EventArgs e)
        {
            form2.ummaeli = rtb_text.Text;
            this.DialogResult = DialogResult.OK;
            this.Close();
        }
        public void GetUmmaeli(string ummaeli)
        {
            rtb_text.Text = ummaeli;
        }
        public string TheValue
        {
            get { return rtb_text.Text; }
        }
    }
}
