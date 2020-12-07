using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;

namespace PopolareDB
{
    class RicercaParametri
    {
        public string Parola { get; set; }
        public string abbreziazione { get; set; }
        public string significato { get; set; }

        public void RicercaElementi(MySqlConnection cn)
        {
            MySqlCommand scm;
            string sql;
            string Source = Environment.GetFolderPath(Environment.SpecialFolder.Desktop)+ @"\dictionary.csv";
            string[] lines = System.IO.File.ReadAllLines(Source);
            foreach (string line in lines)
            {
                abbreziazione = line.Split(',')[1].Trim('"','.');
                if (abbreziazione == "a" || abbreziazione == "v" || abbreziazione == "n" || abbreziazione == "adv")
                {
                    if (abbreziazione == "a")  abbreziazione = "adjective";
                    if (abbreziazione == "v") abbreziazione = "verb";
                    if (abbreziazione == "n") abbreziazione = "noun";
                    if (abbreziazione == "adv") abbreziazione = "adverb";
                    Parola = line.Split(',')[0].Trim('"').Replace("'", " ");
                    significato = line.Split(',')[2].Trim('"').Replace("'"," ");
                    sql = "insert into parole(Nome,Tipologia,significato) values('" + Parola + "','" + abbreziazione + "','" + significato + "');";
                    scm = new MySqlCommand(sql, cn);
                    scm.ExecuteNonQuery();
                }
            }
        }
    }
}
