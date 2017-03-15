var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redisNotification = new Redis();
var redisChat = new Redis();


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


// redisNotification.subscribe('private-notification-channel', function (err, count) {
//     console.log('Error redis: ' + err);
// });
//
// redisNotification.on('message', function (channel, message) {
//     const event = JSON.parse(message);
//
//     //console.log(channel);
//     console.log(event.data.type);
//
//     io.emit(event.data.type, channel, 'MESSAGE FROM REDIS: ' + message);
// });

//На клиенте, делать запрос, может ли он подконектиться к определенной руме, или на определенный экшн, исходя из токена!

redisNotification.psubscribe('*', function (err, count) {
    console.log('Error redis: ' + err);
});

//Как в редисе, тут ниже, раздать только нужным клиентам, или словить событие от клиента (user_info)
redisNotification.on('pmessage', function (sub, channel, message) {
    //const event = JSON.parse(message);

    //console.log(channel);

    console.log('META:' + sub);
    console.log('CH: ' + channel);
    console.log('MSG: ' + message);
    var event = JSON.parse(message);
    console.log('event.type: ' + event.type);
    io.emit(event.data.type, channel, 'MESSAGE FROM REDIS: ' + message);

});


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
    return {
        origins: 'test.loc:*'
    };
});