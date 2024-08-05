using DataAccess.Data;
using DataAccess.Models;
using Microsoft.AspNetCore.Mvc;

namespace TodoListAPI;

public static class Api
{
    public static void ConfigureApi(this WebApplication app)
    {
        app.MapGet("/api/v1/user", GetUsers);
        app.MapGet("/api/v1/user/{id}", GetUser);
        app.MapPost("/api/v1/user", InsertUser);
        app.MapDelete("/api/v1/user", DeleteUser);
        app.MapPut("/api/v1/user", UpdateUser);

        app.MapGet("/api/v1/task", GetTasks);
        app.MapGet("/api/v1/task/{taskId}", GetTask);
        app.MapPost("/api/v1/task", InsertTask);
        app.MapDelete("/api/v1/task", DeleteTask);
        app.MapPut("/api/v1/task", UpdateTask);
    }

    public static async Task<IResult> GetUsers(IUserData db)
    {
        try
        {
            var result = await db.GetUsers();
            return Results.Ok(result);
        }
        catch (Exception ex)
        {
            return Results.Problem(ex.Message);
        }
    }

    public static async Task<IResult> GetUser(IUserData db, int id)
    {
        try
        {
            var result = await db.GetUser(id);
            if (result == null) return Results.NotFound();
            return Results.Ok(result);
        }
        catch (Exception ex)
        {
            return Results.Problem(ex.Message);
        }
    }

    public static async Task<IResult> InsertUser(IUserData db, [FromBody] UserModel user)
    {
        try
        {
            await db.InsertUser(user.username, user.email, user.pwd);
            return Results.Ok();
        }
        catch (Exception ex)
        {
            return Results.Problem(ex.Message);
        }
    }

    public static async Task<IResult> DeleteUser(IUserData db, int id)
    {
        try
        {
            await db.DeleteUser(id);
            return Results.Ok();
        }
        catch (Exception ex)
        {
            return Results.Problem(ex.Message);
        }
    }

    public static async Task<IResult> UpdateUser(IUserData db, [FromBody] UserModel user)
    {
        try
        {
            await db.UpdateUser(user.user_id, user.username, user.email, user.pwd);
            return Results.Ok();
        }
        catch (Exception ex)
        {
            return Results.Problem(ex.Message);
        }
    }

    public static async Task<IResult> GetTasks(ITaskData db, int userId)
    {
        try
        {
            var result = await db.GetTasks(userId);
            return Results.Ok(result);
        }
        catch (Exception ex)
        {
            return Results.Problem(ex.Message);
        }
    }

    public static async Task<IResult> GetTask(ITaskData db, int taskId)
    {
        try
        {
            var result = await db.GetTask(taskId);
            if (result == null) return Results.NotFound();
            return Results.Ok(result);
        }
        catch (Exception ex)
        {
            return Results.Problem(ex.Message);
        }
    }

    public static async Task<IResult> InsertTask(ITaskData db, string name, string description, int userId)
    {
        try
        {
            await db.InsertTask(name, description, userId);
            return Results.Ok();
        }
        catch (Exception ex)
        {
            return Results.Problem(ex.Message);
        }
    }

    public static async Task<IResult> DeleteTask(ITaskData db, int taskId)
    {
        try
        {
            await db.DeleteTask(taskId);
            return Results.Ok();
        }
        catch (Exception ex)
        {
            return Results.Problem(ex.Message);
        }
    }

    public static async Task<IResult> UpdateTask(ITaskData db, [FromBody] TaskModel task)
    {
        try
        {
            await db.UpdateTask(task.task_id, task.task_name, task.task_description, task.is_completed, task.completion_date);
            return Results.Ok();
        }
        catch (Exception ex)
        {
            return Results.Problem(ex.Message);
        }
    }
}
