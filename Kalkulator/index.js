let display = document.getElementById('display')

let buttons = Array.from(document.getElementsByClassName('button'))

buttons.map(button => {
    button.addEventListener('click', (e) => {
        switch (e.target.textContent) {
            case 'C':
                display.textContent = '';
                break
            case '←':
                if (display.textContent) {
                    display.textContent = display.textContent.slice(0, -1);
                }
                break
            case '=':
                if (display.textContent === '') {
                    alert('please input a right number, try again?')
                    display.textContent = '';
                    break
                }
                try {
                    display.textContent = eval(display.textContent);
                } catch {
                    alert('your input wasnt a right number, please try again..')
                    display.textContent = '';
                }
                break
            default:
                display.textContent += e.target.textContent;
                break
        }
    })
})