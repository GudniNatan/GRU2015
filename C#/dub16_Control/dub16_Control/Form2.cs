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
        string notandi;
        public Form2()
        {
            InitializeComponent();
        }
        public void Notandi(string kt)
        {
            notandi = kt;
            lb_notandi.Text = "Notandi: " + kt;
        }
    }
}
