//Зависимости
const app = require("express")();
const http = require('http').Server(app);
const io = require('socket.io')(http, {
    cors: {
        origin: "http://localhost:3000",
        methods: ["GET", "POST"]
    }
});


app.get('/', (req, res) => {
    res.send('Сервер работает!');
});

http.listen(8080, () => {
    console.log('Server is running on port 8080');
})

/**
 * Прослушиватель событий подключения веб-сокетов
 */
io.on('connection', (socket) => {
    socket.emit('news', {data: "data"})
    socket.on('hi', data=>{
        console.log(data);
    })
    socket.on('disconnect', () => {
        console.log('User was disconnected!')
    })
})