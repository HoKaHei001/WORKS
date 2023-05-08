async function fetchData(url, params) {

    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-type': 'application/json'
        },
        body: JSON.stringify(params),
    });

    return await response.json();
}
