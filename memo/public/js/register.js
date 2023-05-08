const inputEmail = document.querySelector('.input_email');
const emailError = document.querySelector('.error')

inputEmail.addEventListener('change', async event => {
    const value = event.target.value;

    const params = {
        email: value,
    }

    const response = await fetch('/memo/public/api/exists-user.php', {
        method: 'POST',
        headers: {
            'Content-type': 'application/json'
        },
        body: JSON.stringify(params),
    });

    const data = await response.json();

    console.log(data);

    // if (true) {
    //     emailError.innerHTML = 'メールアドレスが重複してるよ！';
    // } else {
    //     emailError.innerHTML = '';
    // }
})
