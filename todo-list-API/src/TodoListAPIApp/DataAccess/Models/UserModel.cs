using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DataAccess.Models;

public class UserModel
{
    public int user_id { get; set; }
    public string username { get; set; }
    public string email { get; set; }
    public string pwd { get; set; }
}
