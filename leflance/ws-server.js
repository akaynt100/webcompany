// var app = require('express')();
// var http = require('http').Server(app);
// var io = require('socket.io')(http);
// var Redis = require('ioredis');
// var redisNotification = new Redis();
// var redisChat = new Redis();


/**
 * User notifications
 */
// redisNotification.subscribe('private-notification-channel', function (err, count) {
//     console.log('Error redis: ' + err);
// });
//
// redisNotification.on('message', function (channel, message) {
//     console.log('NOTIFICATION: ' + message);
//     io.emit('send-notification-to-client', 'NOTIFICATION FROM REDIS: ' + message);
// });

//
// redisNotification.subscribe('private-notification-channel', function (err, count) {
//     console.log('Error redis: ' + err);
// });
//
// redisNotification.on('message', function (channel, message) {
//     console.log('NOTIFICATION: ' + message);
//     io.emit('send-notification-to-client', 'MESSAGE FROM REDIS: ' + message);
//     io.emit('send-notification-to-client', 'CHANNEL FROM REDIS: ' + channel);
// });





/**
 * User chat
 */
io.on('connection', function (socket) {

    socket.on('to-server-from-client', function (msg) {
        io.emit('from-server-for-client', 'SERVER ANSWER: ' + msg);
    });

    socket.on('disconnect', function () {
        console.log('user disconnected');
    });

    console.log('connection');
});

http.listen(6001, function () {
    console.log('Listening on Port 6001');
});