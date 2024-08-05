using DataAccess.DbAccess;
using DataAccess.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace DataAccess.Data;

public class UserData : IUserData
{
    private readonly IMySQLDbAccess _db;

    public UserData(IMySQLDbAccess db)
    {
        _db = db;
    }

    public Task<IEnumerable<UserModel>> GetUsers() =>
        _db.LoadData<UserModel, dynamic>("spUser_GetAll", new { });

    public async Task<UserModel?> GetUser(int id)
    {
        var result = await _db.LoadData<UserModel, dynamic>("spUser_Get", new { _user_id = id });
        return result.FirstOrDefault();
    }

    public Task InsertUser(string username, string email, string password) =>
        _db.SaveDate("spUser_Insert", new { _username = username, _email = email, _pwd = password });

    public Task DeleteUser(int id) =>
        _db.SaveDate("spUser_Delete", new { _user_id = id });

    public Task UpdateUser(int id, string username, string email, string password) =>
        _db.SaveDate("spUser_Update", new { _user_id = id, _username = username, _email = email, _pwd = password });

}
