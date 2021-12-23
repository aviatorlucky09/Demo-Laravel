var express = require('express');
require("dotenv").config({path: "./../.env"});
var app = express();
// const db = require('db')

app.get('/', function (req, res) {
   res.send(process.env.APP_NAME);
})

var server = app.listen(4242, function () {
    var host = server.address().address;
    var port = server.address().port;
   
   console.log("Example app listening at http://%s:%s", host, port)
})