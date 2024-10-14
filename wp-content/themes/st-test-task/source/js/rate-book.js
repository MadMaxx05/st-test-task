document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('[data-rate-button]');

    buttons.forEach(button => {
        button.addEventListener('click', async () => {
            const bookId = button.dataset.bookId;
            const actionType = button.dataset.action;

            try {
                let response = await fetch(rate_book.ajax_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'rate_book',
                        book_id: bookId,
                        action_type: actionType
                    })
                });

                let result = await response.json();

                if (result.success) {
                    document.querySelector(`[data-rating-${bookId}]`).innerText = `Rating: ${result.data}`;
                    buttons.forEach(item => item.disabled = true);
                } else {
                    alert(`Error: ${result.data}`);
                }
            } catch (errors) {
                alert(`AJAX Error: ${errors}`);
            }
        });
    });
});
