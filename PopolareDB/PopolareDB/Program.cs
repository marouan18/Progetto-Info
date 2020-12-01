using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using MySql.Data.MySqlClient;

namespace PopolareDB
{
    class Program
    {
        static void Main(string[] args)
        { 
            String ConnectionString = "server=localhost;database=dictionary;uid=root;pwd=root;";
            MySqlConnection cnn = new MySqlConnection(ConnectionString);
            RicercaParametri rp = new RicercaParametri();
            try
            {
                cnn.Open();
                Console.WriteLine("Connection Open!");
                rp.RicercaElementi(cnn);
            }
            catch(Exception ex)
            {
                Console.WriteLine("can not Open Connection!");
                return;
            }
            
        }

    }
}
