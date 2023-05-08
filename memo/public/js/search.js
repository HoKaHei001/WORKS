
const input = document.querySelector('input[name="query"');
const result = document.querySelector('.result');

input.addEventListener('change', async event => {

    const value = event.target.value;

    const params = {
        query: value,
    }

    const data = await fetchData('/memo/public/api/search-memo.php', params);

    // const response = await fetch('/memo/public/api/search-memo.php', {
    //     method: 'POST',
    //     headers: {
    //         'Content-type': 'application/json'
    //     },
    //     body: JSON.stringify(params),
    // });

    // const data = await response.json();

    // console.log(data);
    result.innerHTML = '';

    data.forEach(memo => {
        const li = document.createElement('li');
        li.innerHTML = `${memo.id} ${memo.body}`;
        result.append(li);
    });
});
