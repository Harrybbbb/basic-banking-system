document.getElementById('transfer-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const fromAccount = document.getElementById('from-account').value;
    const toAccount = document.getElementById('to-account').value;
    const amount = document.getElementById('amount').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'transfer.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById('result').innerHTML = xhr.responseText;
        }
    };
    xhr.send(`fromAccount=${fromAccount}&toAccount=${toAccount}&amount=${amount}`);
});