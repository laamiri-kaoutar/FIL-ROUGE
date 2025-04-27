@extends('layouts.app')

@section('title', 'Communications - FreelanceHub')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <style>
        .message-received {
            background-color: #f1f5f9;
            border-radius: 1rem 1rem 1rem 0;
        }
        .message-sent {
            background: linear-gradient(to right, #8a4fff, #ff4f8a);
            color: white;
            border-radius: 1rem 1rem 0 1rem;
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto flex-grow py-8 px-4">
        <div class="max-w-6xl mx-auto overflow-hidden bg-white rounded-xl shadow-sm border border-gray-100">
            <!-- Communication Interface -->
            <div class="flex flex-col md:flex-row h-[650px]">
                <!-- Left Column: Conversation List -->
                <div class="w-full md:w-1/3 border-r border-gray-200 flex flex-col bg-white">
                    <div class="p-5 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Messages</h2>
                    </div>
                    
                    <!-- Conversations List -->
                    <div class="flex-grow overflow-y-auto" id="conversations-list">
                        <!-- Conversations will be loaded here via AJAX -->
                    </div>
                </div>
                
                <!-- Right Column: Chat Window -->
                <div class="w-full md:w-2/3 flex flex-col bg-white">
                    @if($conversation)
                        <!-- Chat Header -->
                        <div class="p-5 border-b border-gray-200 flex items-center bg-white">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-semibold mr-3">
                                    {{ strtoupper(substr($conversation->getOtherParticipant(auth()->id())->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h2 class="font-semibold text-gray-800">{{ $conversation->getOtherParticipant(auth()->id())->name }}</h2>
                                    <p class="text-xs text-gray-500">{{ $conversation->getOtherParticipant(auth()->id())->role->name }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Messages Area -->
                        <div class="flex-grow p-6 overflow-y-auto" id="messages-container">
                            <!-- Messages will be loaded here via AJAX -->
                        </div>
                        
                        <!-- Message Input -->
                        <div class="p-4 border-t border-gray-200 bg-white">
                            <form id="message-form" class="flex items-end bg-gray-50 p-2 rounded-xl border border-gray-200">
                                <div class="flex-grow mx-2">
                                    <textarea 
                                        class="chat-input w-full bg-transparent border-0 p-2 focus:outline-none resize-none text-gray-800"
                                        placeholder="Type your message..."
                                        rows="1"
                                    ></textarea>
                                </div>
                                <button type="submit" class="send-button p-3 rounded-lg text-white font-medium primary-gradient shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Placeholder when no conversation is selected -->
                        <div class="flex-grow flex items-center justify-center text-gray-500">
                            <p>Select a conversation to start chatting</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Get DOM elements
        const conversationsList = document.getElementById('conversations-list');
        const messagesContainer = document.getElementById('messages-container');
        const messageForm = document.getElementById('message-form');
        const messageInput = messageForm ? messageForm.querySelector('.chat-input') : null;
        const currentConversationId = {{ $conversation ? $conversation->id : 'null' }};

        // Load conversations
        function loadConversations() {
            fetch('/conversations', {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                conversationsList.innerHTML = '';
                data.forEach(conversation => {
                    const otherUser = conversation.client_id == {{ auth()->id() }} ? conversation.freelancer : conversation.client;
                    const latestMessage = conversation.messages[0] || null;
                    const isActive = currentConversationId && currentConversationId == conversation.id;

                    // Create conversation item
                    const div = document.createElement('div');
                    div.className = `conversation p-4 pl-3 border-b border-gray-100 cursor-pointer ${isActive ? 'active bg-gray-100' : ''}`;
                    div.innerHTML = `
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-3">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-semibold">
                                    ${otherUser.name.substring(0, 2).toUpperCase()}
                                </div>
                            </div>
                            <div class="flex-grow min-w-0">
                                <div class="flex justify-between items-baseline">
                                    <h3 class="font-medium text-gray-900 truncate">${otherUser.name}</h3>
                                    <span class="text-xs text-gray-500 ml-2 whitespace-nowrap">
                                        ${latestMessage ? new Date(latestMessage.created_at).toLocaleTimeString() : ''}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 truncate mt-1">
                                    ${latestMessage ? latestMessage.content : 'No messages yet'}
                                </p>
                            </div>
                        </div>
                    `;
                    div.addEventListener('click', () => {
                        window.location.href = `/chat/${conversation.id}`;
                    });
                    conversationsList.appendChild(div);
                });
            })
            .catch(error => console.log('Error:', error));
        }

        // Load messages
        function loadMessages() {
            if (!currentConversationId) return;

            fetch(`/conversations/${currentConversationId}/messages`, {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(messages => {
                messagesContainer.innerHTML = '';
                messages.forEach(message => {
                    const isSent = message.sender_id == {{ auth()->id() }};
                    const div = document.createElement('div');
                    div.className = `flex mb-5 ${isSent ? 'justify-end' : ''}`;
                    div.innerHTML = `
                        ${!isSent ? `
                            <div class="flex-shrink-0 mr-3 self-end">
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 text-xs font-semibold">
                                    ${message.sender.name.substring(0, 2).toUpperCase()}
                                </div>
                            </div>
                        ` : ''}
                        <div class="max-w-[75%]">
                            <div class="${isSent ? 'message-sent' : 'message-received'} p-4">
                                <p>${message.content}</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-1 ${isSent ? 'text-right mr-1' : 'ml-1'}">
                                ${new Date(message.created_at).toLocaleTimeString()}
                            </p>
                        </div>
                    `;
                    messagesContainer.appendChild(div);
                });
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            })
            .catch(error => console.log('Error:', error));
        }

        // Send message
        if (messageForm) {
            messageForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const content = messageInput.value.trim();
                if (!content) return;

                fetch(`/conversations/${currentConversationId}/messages`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ content })
                })
                .then(response => response.json())
                .then(message => {
                    messageInput.value = '';
                    loadMessages();
                })
                .catch(error => console.log('Error:', error));
            });
        }

        // Load data on page load
        loadConversations();
        loadMessages();
    </script>
@endsection