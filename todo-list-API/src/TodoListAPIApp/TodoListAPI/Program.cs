using DataAccess.Data;
using DataAccess.DbAccess;
using TodoListAPI;

var builder = WebApplication.CreateBuilder(args);

builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

// Adding our own dependency injection
builder.Services.AddSingleton<IMySQLDbAccess, MySQLDbAccess>();
builder.Services.AddSingleton<IUserData, UserData>();
builder.Services.AddSingleton<ITaskData, TaskData>();

var app = builder.Build();

// Configure the HTTP request pipeline.
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}

app.UseHttpsRedirection();

app.ConfigureApi();

app.Run();
