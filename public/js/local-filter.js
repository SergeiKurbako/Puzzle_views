var fromDate = document.getElementById('from--filter--date'),
    toDate = document.getElementById('to--filter--date'),
    gender = document.getElementById('gender'),
    fromPrice = document.getElementById('from_price'),
    toPrice = document.getElementById('to_price');


var btnReset = document.getElementById('btn--reset-filter');

btnReset.onclick = function(e){
    e.preventDefault();

    resetFilter();
}

function resetFilter(){
    sessionStorage.clear();
    location.reload()
}

function urlDistribution(){
    if(window.location.pathname.indexOf('/frame') != -1) lidsFilter();
    else if(window.location.pathname.indexOf('/complaints') != -1) complaintsFilter();
    else return;
}

function lidsFilter(){
    var resultGame = document.getElementById("result_game");

    if(sessionStorage.getItem("lisdFromDate") != null)fromDate.value = sessionStorage.getItem("lisdFromDate");
    if(sessionStorage.getItem("lisdToDate") != null)toDate.value = sessionStorage.getItem("lisdToDate");
    if(sessionStorage.getItem("lisdGender") != null)gender.value = sessionStorage.getItem("lisdGender");
    if(sessionStorage.getItem("lisdFromPrice") != null)fromPrice.value = sessionStorage.getItem("lisdFromPrice");
    if(sessionStorage.getItem("lisdToPrice") != null)toPrice.value = sessionStorage.getItem("lisdToPrice");
    if(sessionStorage.getItem("lisdResultGame") != null)resultGame.value = sessionStorage.getItem("lisdResultGame");

    fromDate.onblur = function(){
        setTimeout(() => sessionStorage.setItem("lisdFromDate",fromDate.value), 500);
    }

    toDate.onblur = function(){
        setTimeout(() => sessionStorage.setItem("lisdToDate",toDate.value), 500);
    }

    gender.onclick = function(){
        sessionStorage.setItem("lisdGender",gender.value);
    }

    fromPrice.onblur = function(){
        sessionStorage.setItem("lisdFromPrice",fromPrice.value);
    }

    toPrice.onblur = function(){
        sessionStorage.setItem("lisdToPrice",toPrice.value);
    }

    resultGame.onclick = function(){
        sessionStorage.setItem("lisdResultGame",resultGame.value);
    }
}

function complaintsFilter(){
    var status = document.getElementById("status");

    if(sessionStorage.getItem("complaintsFromDate") != null)fromDate.value = sessionStorage.getItem("complaintsFromDate");
    if(sessionStorage.getItem("complaintsToDate") != null)toDate.value = sessionStorage.getItem("complaintsToDate");
    if(sessionStorage.getItem("complaintsGender") != null)gender.value = sessionStorage.getItem("complaintsGender");
    if(sessionStorage.getItem("complaintFromPrice") != null)fromPrice.value = sessionStorage.getItem("complaintFromPrice");
    if(sessionStorage.getItem("complaintToPrice") != null)toPrice.value = sessionStorage.getItem("complaintToPrice");
    if(sessionStorage.getItem("complaintStatus") != null)status.value = sessionStorage.getItem("complaintStatus");

    fromDate.onblur = function(){
        setTimeout(() => sessionStorage.setItem("complaintsFromDate",fromDate.value), 500);
    }

    toDate.onblur = function(){
        setTimeout(() => sessionStorage.setItem("complaintsToDate",toDate.value), 500);
    } 

    gender.onclick = function(){
        sessionStorage.setItem("complaintsGender",gender.value);
    }

    fromPrice.onblur = function(){
        sessionStorage.setItem("complaintFromPrice",fromPrice.value);
    }

    toPrice.onblur = function(){
        sessionStorage.setItem("complaintToPrice",toPrice.value);
    }

    status.onclick = function(){
        sessionStorage.setItem("complaintStatus",status.value);
    }
}

urlDistribution();