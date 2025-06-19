let result = document.getElementById('result');
function mainSubmit () {
    event.preventDefault();
    let name = document.querySelector('#name').value.trim();
    let gender = document.querySelector('#gender').value;
    let sports = Array.from(document.querySelectorAll('input[name="sport"]:checked')).map(cb => cb.value);
    let message = document.querySelector('#message').value.trim();

    let cardClass = gender === 'Male' ? 'card male' : 'card female';
    let changeTo = gender === 'Male' ? 'Mr.' : 'Ms.';

    let cardHTML = `
        <div class="${cardClass}">
            <h1>${changeTo} ${name}</h1>
            <p>interests: ${sports.length ? sports.join(', ') : 'None'}</p>
            <p>${message ? message : 'No message provided.'}</p>
        </div>
    `;

    document.querySelector('form').reset();
    result.innerHTML += cardHTML;
}