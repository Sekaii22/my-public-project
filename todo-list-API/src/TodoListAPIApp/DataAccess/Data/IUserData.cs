
using DataAccess.Models;

namespace DataAccess.Data
{
    public interface IUserData
    {
        Task DeleteUser(int id);
        Task<UserModel?> GetUser(int id);
        Task<IEnumerable<UserModel>> GetUsers();
        Task InsertUser(string username, string email, string password);
        Task UpdateUser(int id, string username, string email, string password);
    }
}