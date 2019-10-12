 function actionStartGame(reqData){
    const { width, height } = reqData;
    const url = `../games/action?action=open_game&maze_width=${width}&maze_height=${height}&game_id=1&start_cell_x=0&end_cell_x=0&start_cell_y=0&end_cell_y=0&user_id=1&session_uuid=&mode=full`
    console.log(url)
    fetch(url)
    .then(res=>res.json())
    .then(res=>{
        console.log(res)
        const {logicData,sessionData} = res
        BasicGame.mazeData = logicData
        window.uuid = sessionData.sessionUuid
    })
}
function actionMove(reqData){
    
    const gameId = 1;
    const userId = getUrlVars()["lid_id"];
    const {x,y} = reqData
    const url = `../games/action?action=move&game_id=${gameId}&cell_x=${x}&cell_y=${y}&user_id=${userId}&session_uuid=${uuid}&mode=full`
    fetch(url)
    .then(res=>res.json())
    .then(res=>{
        // console.log(res)
    })
}

function actionEndGame(reqData){
    const gameId = 1;
    const userId = getUrlVars()["lid_id"];
    const url = `../games/action?action=end_game&game_id=${gameId}&user_id=${userId}&session_uuid=${uuid}&mode=full`
    fetch(url)
    .then(res=>res.json())
    .then(res=>{
        console.log(res)
    })
}

function getUrlVars() {
    var vars = {};
    window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}