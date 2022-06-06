//Зависимости
const app = require("express")();
const http = require('http').Server(app);
const io = require('socket.io')(http, {
    cors: {
        origin: "http://localhost:3000",
        methods: ["GET", "POST"]
    }
});

/**
 * Тест работы
 */
app.get('/', (req, res) => {
    res.send('Сервер работает!');
});

/**
 * Запуск сервера
 */
http.listen(8080, () => {
    console.log('Server is running on port 8080');
})

/**
 * Прослушиватель событий подключения веб-сокетов
 */
io.on('connection', (socket) => {
    console.log('User was connected');

    const {roomId} = socket.handshake.query;

    socket.roomId = roomId;

    socket.join(roomId);

    socket.on('sendMessage', data => {
        let message = {
            "from_id": data['from_id'],
            "to_id": 1,
            "text": data["text"],
            "was_read": false,
        }
        socket.in(socket.roomId).emit('getMessage', message)
        // console.log(message);

        // socket.emit('getMessage', data)
        //Записываем сообщения в бД
        // fetch('http://php/message/create', {
        //     method: "POST",
        //     headers: {
        //         'Content-Type': 'application/json;charset=utf-8'
        //     },
        //     body: JSON.stringify(message)
        // }).then(res => res.json())
        //     .then(
        //         /** @deprecated */
        //         //Теперь получим все сообщения этого чата
        //         // fetch('http://php/message/get-user-messages?userId='+data['from_id'], {
        //         //     method: "GET"
        //         // }).then(res => res.json())
        //         //     .then(messages => socket.emit('getMessage', messages))
        //         //     .catch(console.error)
        //         /** Теперь отправим это сообщение всем подключенным пользователям */
        //         data => socket.emit('getMessage', data)
        //     )
        //     .catch(console.error)

    })
    socket.on('disconnect', () => {
        console.log('User was disconnected!')
    })
})