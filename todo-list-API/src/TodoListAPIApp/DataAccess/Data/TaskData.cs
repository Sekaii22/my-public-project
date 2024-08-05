using DataAccess.DbAccess;
using DataAccess.Models;
using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DataAccess.Data;

public class TaskData : ITaskData
{
    private readonly IMySQLDbAccess _db;

    public TaskData(IMySQLDbAccess db)
    {
        _db = db;
    }

    public Task<IEnumerable<TaskModel>> GetTasks(int userId) =>
        _db.LoadData<TaskModel, dynamic>("spTask_GetAll", new { _user_id = userId });

    public async Task<TaskModel?> GetTask(int taskId)
    {
        var result = await _db.LoadData<TaskModel, dynamic>("spTask_Get", new { _task_id = taskId });
        return result.FirstOrDefault();
    }

    public Task DeleteTask(int taskId) =>
        _db.SaveDate("spTask_Delete", new { _task_id = taskId });

    public Task InsertTask(string name, string description, int userId) =>
        _db.SaveDate(
            "spTask_Insert",
            new { _task_name = name, _task_description = description, _is_completed = false, _user_id = userId });

    public Task UpdateTask(int taskId, string name, string description, bool isCompleted, DateTime? completionDate) =>
        _db.SaveDate(
            "spTask_Update",
            new { _task_id = taskId, _task_name = name, _task_description = description, _is_completed = isCompleted, _completion_date = completionDate });
}
