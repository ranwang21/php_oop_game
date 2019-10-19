// get all disabled keys
const disabled = document.querySelectorAll('[disabled]');
// listen to the keyboard
document.addEventListener('keypress', event =>{
    // get ley pressed
    const {key} = event;
    let flag = false;
    // check if the key is disabled
    disabled.forEach(disable => {
        if (key === disable.value){
            flag = true;
        }
    });
    // if key pressed is not disabled, is in (a-z), and current page is not the index page, visit play.php with the key as parameter
    if(flag === false && /^[a-z]$/.test(key) && window.location.href.indexOf("index") === -1){
        window.location.href = `/play.php?key=${key}`;
    }
});