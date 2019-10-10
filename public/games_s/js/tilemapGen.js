function tilemapGenerator(data,w,h){
    var tilemapData = []
    JSON.parse(data).forEach(arr=>{
        arr.forEach(item=>{
            if(item==1){
                tilemapData.push(0)
            }
            if(item==0){
                tilemapData.push(1)
            }
        })
    })
    var map = {
        height:h,
        layers:[
            {
             data:tilemapData,
             height:h,
             name:"Tile Layer 1",
             opacity:1,
             type:"tilelayer",
             visible:true,
             width:w,
             x:0,
             y:0
            }],
     nextobjectid:1,
     orientation:"orthogonal",
     properties:
        {

        },
     renderorder:"right-down",
     tileheight:32,
     tilesets:[
            {
             firstgid:1,
             image:"../images/wall.png",
             imageheight:32,
             imagewidth:32,
             margin:0,
             name:"level",
             properties:
                {

                },
             spacing:0,
             tileheight:32,
             tilewidth:32
            }],
     tilewidth:32,
     version:1,
     width:w
    }
    var blob = new Blob([JSON.stringify(map)], {type : 'application/json'})
    var tilemapPAth = URL.createObjectURL(blob)
    return tilemapPAth
}
