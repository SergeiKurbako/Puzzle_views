var socket = new WebSocket('ws://demos.kaazing.com/echo');
socket.onopen=socketOpen
socket.onclose=socketClose
socket.onmessage=socketMessage
function socketOpen(e){
    console.log('connect');
    socket.send('ok')
    console.log(socket.readyState)
    socket.send('ok')
    console.log(socket.readyState)
    socket.send('ok')
    console.log(socket.readyState)
    socket.send('close')
    console.log(socket.readyState)
}
function socketClose(){
    console.log('disconnect');

}
function socketMessage(e){
    console.log(e)
    if(e.data=="close"){
        socket.close()
    }
    
}
class gameSocket{
    constructor(){
        url = 'ws://demos.kaazing.com/echo'
    }
    onOpen(e){
        
    }
    run(){
        this.socket = new WebSocket(this.url);
    }
}
console.log(socket.readyState)