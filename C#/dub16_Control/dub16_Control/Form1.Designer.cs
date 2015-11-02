namespace dub16_Control
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.tb_kennitala = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.bt_innskra = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // tb_kennitala
            // 
            this.tb_kennitala.Font = new System.Drawing.Font("Microsoft Sans Serif", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tb_kennitala.Location = new System.Drawing.Point(186, 134);
            this.tb_kennitala.Name = "tb_kennitala";
            this.tb_kennitala.Size = new System.Drawing.Size(228, 32);
            this.tb_kennitala.TabIndex = 0;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(56, 137);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(103, 26);
            this.label1.TabIndex = 1;
            this.label1.Text = "Kennitala";
            // 
            // bt_innskra
            // 
            this.bt_innskra.Font = new System.Drawing.Font("Microsoft Sans Serif", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.bt_innskra.Location = new System.Drawing.Point(101, 213);
            this.bt_innskra.Name = "bt_innskra";
            this.bt_innskra.Size = new System.Drawing.Size(232, 53);
            this.bt_innskra.TabIndex = 2;
            this.bt_innskra.Text = "Innskrá (admin only)";
            this.bt_innskra.UseVisualStyleBackColor = true;
            this.bt_innskra.Click += new System.EventHandler(this.bt_innskra_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(451, 424);
            this.Controls.Add(this.bt_innskra);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.tb_kennitala);
            this.Name = "Form1";
            this.Text = "Form1";
            this.Load += new System.EventHandler(this.Form1_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.TextBox tb_kennitala;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Button bt_innskra;
    }
}

