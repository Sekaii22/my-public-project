using DataAccess.Models;

namespace DataAccess.Data
{
    public interface ITaskData
    {
        Task DeleteTask(int taskId);
        Task<TaskModel?> GetTask(int taskId);
        Task<IEnumerable<TaskModel>> GetTasks(int userId);
        Task InsertTask(string name, string description, int userId);
        Task UpdateTask(int taskId, string name, string description, bool isCompleted, DateTime? completionDate);
    }
}