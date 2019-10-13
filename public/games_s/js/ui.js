
function renderUI(structure, parentSelector) {
    let { tag, className, content, children } = structure;
    let element = document.createElement(tag)
    element.setAttribute('class', className)
    if (content) {
        element.innerHTML = content
    }
    let parent = document.querySelector(parentSelector)
    parent.appendChild(element)
    if (children) {
        children.forEach(child => {
            renderUI(child, `.${className}`)
        });
    }
}
var menuStructure = {
    tag: 'div',
    className: 'menu-container',
    children: [
        {
            tag: 'button',
            content: 'demo',
            className: 'menu-container__demo-btn btn btn-secondary'
        },
        {
            tag: 'button',
            content: 'stop',
            className: 'menu-container__stop-btn btn btn-secondary'
        },
        {
            tag: 'button',
            content: 'restart',
            className: 'menu-container__restart-btn btn btn-secondary'
        },
        {
            tag: 'span',
            content: '0s',
            className: 'menu-container__time-widget'
        }
    ]
}

function renderSpeedPanel() {
    let template = `
    <div class="speed-panel__input-container">
        <label for="speed-input">Скорость игрока</label>
        <input type="number" value="${HERO_SPEED}"  class="form-control speed-panel__speed-input" id="speed-input">
    </div>

    <div class="speed-panel__input-container">
        <span>Скорость врага</span>
        <input type="number" class="form-control speed-panel__enemy-speed" min="0" value="${ENEMY_SPEED}" step='1'>
    </div>
    <div class="speed-panel__input-container">
        <span>размеры</span>
        <div>
            <input type="range" value="${GAME_WIDTH/32}" min="4" max="50" class="form-control speed-panel__game-width-input" id="game-width-input">
            <label for="game-width-input"  class="game-width-label">ширина ${GAME_WIDTH/32} клеток</label>
        </div>
        <div>
            <input type="range" value="${GAME_HEIGHT/32}" min="4" max="50" class="form-control speed-panel__game-height-input" id="game-height-input">
            <label for="game-height-input" class="game-height-label">высота ${GAME_HEIGHT/32} клеток</label>
        </div>
    </div>
    <div class="speed-panel__input-container">
        <span>скорость уменьшения здоровья</span>
        <input type="number" class="form-control speed-panel__health-reduction-rate" min="0" value="${HEALTH_REDUCTION_RATE}" step='0.01'>
    </div>
    `;
    const speedPanel = document.createElement('div');
    speedPanel.classList.add('speed-panel')
    speedPanel.innerHTML = template;
    let gameContainer = document.querySelector(".side-panel")
    gameContainer.appendChild(speedPanel)
}
function FS(){
    document.body.requestFullscreen();
}
