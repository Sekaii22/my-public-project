using Microsoft.Extensions.Configuration;
using Dapper;
using MySql.Data.MySqlClient;
using System.Data;

namespace DataAccess.DbAccess;

public class MySQLDbAccess : IMySQLDbAccess
{
    private readonly IConfiguration _config;

    public MySQLDbAccess(IConfiguration config)
    {
        _config = config;
    }

    public async Task<IEnumerable<T>> LoadData<T, U>(
        string storedProcedure,
        U parameters,
        string connectionId = "Default")
    {
        // create db connection
        using IDbConnection connection = new MySqlConnection(_config.GetConnectionString(connectionId));

        // execute sql statement
        return await connection.QueryAsync<T>(storedProcedure, parameters,
            commandType: CommandType.StoredProcedure);
    }

    public async Task SaveDate<T>(
        string storedProcedure,
        T parameters,
        string connectionId = "Default")
    {
        // create db connection
        using IDbConnection connection = new MySqlConnection(_config.GetConnectionString(connectionId));

        // execute sql statement
        await connection.ExecuteAsync(storedProcedure, parameters,
            commandType: CommandType.StoredProcedure);
    }
}
