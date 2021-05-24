using Microsoft.EntityFrameworkCore;

namespace CRUDAPI.models
{
    public class Contexto : DbContext
    {
        public DbSet<Pessoa> Pessoas { get; set; }
        
        public Contexto(DbContextOptions<Contexto> opcoes) : base(opcoes)
        {
            
        }

        protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder){
            optionsBuilder.UseSqlServer("Password=123456;Persist Security Info=True;User ID=adson;Initial Catalog=AngAPI;Data Source=DESKTOP-T0CDJGN\\SQLEXPRESS");
        }
        
    }
}