<!-- resources/views/chat.blade.php -->
@extends('layouts.app')

@section('title', 'Communications - FreelanceHub')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
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
                        <div class="mt-2 relative">
                            <input type="text" placeholder="Search conversations..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-200 focus:border-purple-300 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-3 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Conversations List -->
                    <div class="flex-grow overflow-y-auto">
                        <!-- Conversation 1 (Active/Selected) -->
                        <div class="conversation active p-4 pl-3 border-b border-gray-100 cursor-pointer" data-conversation-id="1">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-semibold">
                                        SJ
                                    </div>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex justify-between items-baseline">
                                        <h3 class="font-medium text-gray-900 truncate">Sarah Johnson</h3>
                                        <span class="text-xs text-gray-500 ml-2 whitespace-nowrap">12:45 PM</span>
                                    </div>
                                    <p class="text-sm text-gray-600 truncate mt-1">I've completed the initial designs for the project.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Conversation 2 (Unread) -->
                        <div class="conversation p-4 pl-3 border-b border-gray-100 cursor-pointer" data-conversation-id="2">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold">
                                        AR
                                    </div>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex justify-between items-baseline">
                                        <div class="flex items-center">
                                            <h3 class="font-medium text-gray-900 truncate">Alex Rodriguez</h3>
                                            <span class="unread-indicator ml-2 w-2 h-2 rounded-full"></span>
                                        </div>
                                        <span class="text-xs text-gray-500 ml-2 whitespace-nowrap">Yesterday</span>
                                    </div>
                                    <p class="text-sm text-gray-600 font-semibold truncate mt-1">Could you provide feedback on the latest milestone?</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Conversation 3 -->
                        <div class="conversation p-4 pl-3 border-b border-gray-100 cursor-pointer" data-conversation-id="3">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-semibold">
                                        MC
                                    </div>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex justify-between items-baseline">
                                        <h3 class="font-medium text-gray-900 truncate">Michael Chen</h3>
                                        <span class="text-xs text-gray-500 ml-2 whitespace-nowrap">Mar 15</span>
                                    </div>
                                    <p class="text-sm text-gray-600 truncate mt-1">The contract details look good. I can start next Monday.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Chat Window -->
                <div class="w-full md:w-2/3 flex flex-col bg-white">
                    <!-- Chat Header -->
                    <div class="p-5 border-b border-gray-200 flex items-center justify-between bg-white">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-semibold mr-3">
                                SJ
                            </div>
                            <div>
                                <h2 class="font-semibold text-gray-800">Sarah Johnson</h2>
                                <p class="text-xs text-gray-500">Web Designer • Last active: 5 min ago</p>
                            </div>
                        </div>
                        <div class="flex">
                            <button class="p-2 rounded-full hover:bg-gray-100 transition-colors" title="Call">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </button>
                            <button class="p-2 rounded-full hover:bg-gray-100 transition-colors ml-1" title="More options">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Messages Area -->
                    <div class="flex-grow p-6 overflow-y-auto chat-container" id="messages-container">
                        <!-- Day Separator -->
                        <div class="flex justify-center my-4">
                            <span class="text-xs bg-white text-gray-500 px-4 py-1 rounded-full shadow-sm border border-gray-100">Today</span>
                        </div>
                        
                        <!-- Received Message -->
                        <div class="flex mb-5">
                            <div class="flex-shrink-0 mr-3 self-end">
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 text-xs font-semibold">
                                    SJ
                                </div>
                            </div>
                            <div class="max-w-[75%]">
                                <div class="message-received p-4">
                                    <p class="text-gray-800">Hi there! I've completed the initial designs for the project and wanted to get your feedback before proceeding further.</p>
                                </div>
                                <p class="text-xs text-gray-500 mt-1 ml-1">10:30 AM</p>
                            </div>
                        </div>
                        
                        <!-- Sent Message -->
                        <div class="flex mb-5 justify-end">
                            <div class="max-w-[75%]">
                                <div class="message-sent p-4">
                                    <p>Thanks for the update! I'll take a look at them today and get back to you with my thoughts.</p>
                                </div>
                                <p class="text-xs text-gray-500 mt-1 text-right mr-1">11:15 AM</p>
                            </div>
                        </div>
                        
                        <!-- Received Message -->
                        <div class="flex mb-5">
                            <div class="flex-shrink-0 mr-3 self-end">
                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 text-xs font-semibold">
                                    SJ
                                </div>
                            </div>
                            <div class="max-w-[75%]">
                                <div class="message-received p-4">
                                    <p class="text-gray-800">Great! I've also included some notes about the color scheme variations we discussed last week. Let me know if you prefer option A or B.</p>
                                </div>
                                <p class="text-xs text-gray-500 mt-1 ml-1">11:42 AM</p>
                            </div>
                        </div>
                        
                        <!-- Sent Message -->
                        <div class="flex mb-5 justify-end">
                            <div class="max-w-[75%]">
                                <div class="message-sent p-4">
                                    <p>I just looked at both options. I think option B aligns better with our brand guidelines. Could you proceed with that one?</p>
                                </div>
                                <p class="text-xs text-gray-500 mt-1 text-right mr-1">12:45 PM</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Message Input -->
                    <div class="p-4 border-t border-gray-200 bg-white">
                        <form id="message-form" class="flex items-end bg-gray-50 p-2 rounded-xl border border-gray-200">
                            <button type="button" class="p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100" title="Attach file">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                            </button>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/chat.js') }}" defer></script>
@endsection