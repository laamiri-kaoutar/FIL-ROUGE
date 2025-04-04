document.addEventListener('DOMContentLoaded', function() {
    const conversations = document.querySelectorAll('.conversation');
    
    conversations.forEach(conversation => {
        conversation.addEventListener('click', function() {
            conversations.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            
            const unreadIndicator = this.querySelector('.unread-indicator');
            if (unreadIndicator) unreadIndicator.remove();
            
            const messageText = this.querySelector('p');
            if (messageText) messageText.classList.remove('font-semibold');
        });
    });
    
    const messageForm = document.getElementById('message-form');
    messageForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const textarea = this.querySelector('textarea');
        const messageText = textarea.value.trim();
        
        if (messageText) {
            const messagesContainer = document.getElementById('messages-container');
            const messageHTML = `
                <div class="flex mb-5 justify-end">
                    <div class="max-w-[75%]">
                        <div class="message-sent p-4">
                            <p>${messageText}</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 text-right mr-1">Just now</p>
                    </div>
                </div>
            `;
            
            messagesContainer.insertAdjacentHTML('beforeend', messageHTML);
            textarea.value = '';
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    });
});