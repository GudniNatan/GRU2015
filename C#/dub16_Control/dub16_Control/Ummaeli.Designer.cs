namespace dub16_Control
{
    partial class Ummaeli
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
            this.rtb_text = new System.Windows.Forms.RichTextBox();
            this.bt_submit = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // rtb_text
            // 
            this.rtb_text.Location = new System.Drawing.Point(13, 13);
            this.rtb_text.Name = "rtb_text";
            this.rtb_text.Size = new System.Drawing.Size(259, 198);
            this.rtb_text.TabIndex = 0;
            this.rtb_text.Text = "";
            // 
            // bt_submit
            // 
            this.bt_submit.Location = new System.Drawing.Point(102, 226);
            this.bt_submit.Name = "bt_submit";
            this.bt_submit.Size = new System.Drawing.Size(75, 23);
            this.bt_submit.TabIndex = 1;
            this.bt_submit.Text = "Submit";
            this.bt_submit.UseVisualStyleBackColor = true;
            this.bt_submit.Click += new System.EventHandler(this.bt_submit_Click);
            // 
            // Ummaeli
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(284, 261);
            this.Controls.Add(this.bt_submit);
            this.Controls.Add(this.rtb_text);
            this.Name = "Ummaeli";
            this.Text = "Ummaeli";
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.RichTextBox rtb_text;
        private System.Windows.Forms.Button bt_submit;
    }
}