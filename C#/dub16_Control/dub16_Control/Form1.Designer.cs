﻿namespace dub16_Control
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
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Form1));
            this.tb_kennitala = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.bt_innskra = new System.Windows.Forms.Button();
            this.label2 = new System.Windows.Forms.Label();
            this.tb_lykilord = new System.Windows.Forms.TextBox();
            this.pictureBoxLoadIcon = new System.Windows.Forms.PictureBox();
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoxLoadIcon)).BeginInit();
            this.SuspendLayout();
            // 
            // tb_kennitala
            // 
            this.tb_kennitala.Font = new System.Drawing.Font("Microsoft Sans Serif", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tb_kennitala.Location = new System.Drawing.Point(176, 77);
            this.tb_kennitala.Name = "tb_kennitala";
            this.tb_kennitala.Size = new System.Drawing.Size(228, 32);
            this.tb_kennitala.TabIndex = 0;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Font = new System.Drawing.Font("Microsoft Sans Serif", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label1.Location = new System.Drawing.Point(46, 80);
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
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Font = new System.Drawing.Font("Microsoft Sans Serif", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.label2.Location = new System.Drawing.Point(62, 144);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(87, 26);
            this.label2.TabIndex = 4;
            this.label2.Text = "Lykilorð";
            // 
            // tb_lykilord
            // 
            this.tb_lykilord.Font = new System.Drawing.Font("Microsoft Sans Serif", 16F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.tb_lykilord.Location = new System.Drawing.Point(176, 141);
            this.tb_lykilord.Name = "tb_lykilord";
            this.tb_lykilord.PasswordChar = '•';
            this.tb_lykilord.Size = new System.Drawing.Size(228, 32);
            this.tb_lykilord.TabIndex = 1;
            // 
            // pictureBoxLoadIcon
            // 
            this.pictureBoxLoadIcon.Image = ((System.Drawing.Image)(resources.GetObject("pictureBoxLoadIcon.Image")));
            this.pictureBoxLoadIcon.InitialImage = ((System.Drawing.Image)(resources.GetObject("pictureBoxLoadIcon.InitialImage")));
            this.pictureBoxLoadIcon.Location = new System.Drawing.Point(413, 381);
            this.pictureBoxLoadIcon.Name = "pictureBoxLoadIcon";
            this.pictureBoxLoadIcon.Size = new System.Drawing.Size(26, 31);
            this.pictureBoxLoadIcon.SizeMode = System.Windows.Forms.PictureBoxSizeMode.Zoom;
            this.pictureBoxLoadIcon.TabIndex = 5;
            this.pictureBoxLoadIcon.TabStop = false;
            this.pictureBoxLoadIcon.Visible = false;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(451, 424);
            this.Controls.Add(this.pictureBoxLoadIcon);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.tb_lykilord);
            this.Controls.Add(this.bt_innskra);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.tb_kennitala);
            this.Name = "Form1";
            this.Text = "Form1";
            this.Load += new System.EventHandler(this.Form1_Load);
            ((System.ComponentModel.ISupportInitialize)(this.pictureBoxLoadIcon)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.TextBox tb_kennitala;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Button bt_innskra;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox tb_lykilord;
        private System.Windows.Forms.PictureBox pictureBoxLoadIcon;
    }
}

