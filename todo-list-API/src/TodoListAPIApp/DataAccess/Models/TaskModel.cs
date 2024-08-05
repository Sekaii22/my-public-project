using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DataAccess.Models;

public class TaskModel
{
    public int task_id { get; set; }
    public string task_name { get; set; }
    public string? task_description { get; set; }
    public bool is_completed { get; set; }
    public DateTime? completion_date { get; set; } // yyyy-MM-dd format
    public int user_id { get; set; }
}
