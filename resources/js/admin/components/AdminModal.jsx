import React, { useState } from 'react';
import * as Dialog from '@radix-ui/react-dialog';

const AdminModal = ({ type, itemId }) => {
    const [isOpen, setIsOpen] = useState(false);
    const [isLoading, setIsLoading] = useState(false);

    const getModalConfig = () => {
        switch (type) {
            case 'delete-user':
                return {
                    title: 'Delete User',
                    description: 'Are you sure you want to delete this user? This action cannot be undone.',
                    actionText: 'Delete User',
                    actionClass: 'bg-red-600 hover:bg-red-700',
                    endpoint: `/admin/users/${itemId}`,
                    method: 'DELETE'
                };
            case 'delete-post':
                return {
                    title: 'Delete Post',
                    description: 'Are you sure you want to delete this post? This action cannot be undone.',
                    actionText: 'Delete Post',
                    actionClass: 'bg-red-600 hover:bg-red-700',
                    endpoint: `/admin/posts/${itemId}`,
                    method: 'DELETE'
                };
            case 'delete-comment':
                return {
                    title: 'Delete Comment',
                    description: 'Are you sure you want to delete this comment? This action cannot be undone.',
                    actionText: 'Delete Comment',
                    actionClass: 'bg-red-600 hover:bg-red-700',
                    endpoint: `/admin/comments/${itemId}`,
                    method: 'DELETE'
                };
            case 'logout':
                return {
                    title: 'Confirm Logout',
                    description: 'Are you sure you want to logout? You will need to login again to access the admin dashboard.',
                    actionText: 'Logout',
                    actionClass: 'bg-orange-600 hover:bg-orange-700',
                    endpoint: '/logout',
                    method: 'POST'
                };
            default:
                return {
                    title: 'Confirm Action',
                    description: 'Are you sure you want to perform this action?',
                    actionText: 'Confirm',
                    actionClass: 'bg-blue-600 hover:bg-blue-700',
                    endpoint: '#',
                    method: 'POST'
                };
        }
    };

    const config = getModalConfig();

    const handleAction = async () => {
        setIsLoading(true);
        
        try {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = config.endpoint;
            
            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (csrfToken) {
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);
            }
            
            // Add method spoofing if needed
            if (config.method !== 'POST') {
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = config.method;
                form.appendChild(methodInput);
            }
            
            document.body.appendChild(form);
            form.submit();
        } catch (error) {
            console.error('Error performing action:', error);
            alert('Something went wrong. Please try again.');
        } finally {
            setIsLoading(false);
            setIsOpen(false);
        }
    };

    const getTriggerButton = () => {
        if (type === 'logout') {
            return (
                <button className="w-full flex items-center gap-3 px-4 py-3 text-slate-300 bg-gray-700 hover:bg-orange-600 hover:text-white rounded-lg transition-colors">
                    <span className="text-lg">🚪</span>
                    Logout
                </button>
            );
        }
        
        return (
            <button className="bg-red-500 text-white px-3 py-1 text-sm rounded hover:bg-red-600 transition-colors">
                Delete
            </button>
        );
    };

    return (
        <Dialog.Root open={isOpen} onOpenChange={setIsOpen}>
            <Dialog.Trigger asChild>
                {getTriggerButton()}
            </Dialog.Trigger>
            
            <Dialog.Portal>
                <Dialog.Overlay className="fixed inset-0 bg-black/50 z-50" />
                <Dialog.Content className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg p-6 w-full max-w-md z-50 shadow-xl">
                    <Dialog.Title className="text-lg font-semibold text-gray-900 mb-2">
                        {config.title}
                    </Dialog.Title>
                    
                    <Dialog.Description className="text-gray-600 mb-6">
                        {config.description}
                    </Dialog.Description>
                    
                    <div className="flex justify-end gap-3">
                        <Dialog.Close asChild>
                            <button 
                                className="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300 transition-colors"
                                disabled={isLoading}
                            >
                                Cancel
                            </button>
                        </Dialog.Close>
                        
                        <button
                            onClick={handleAction}
                            disabled={isLoading}
                            className={`px-4 py-2 text-white rounded transition-colors ${config.actionClass} disabled:opacity-50 disabled:cursor-not-allowed`}
                        >
                            {isLoading ? 'Processing...' : config.actionText}
                        </button>
                    </div>
                    
                    <Dialog.Close asChild>
                        <button 
                            className="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
                            aria-label="Close"
                        >
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path 
                                    d="M11.7816 4.03157C12.0062 3.80702 12.0062 3.44295 11.7816 3.2184C11.5571 2.99385 11.193 2.99385 10.9685 3.2184L7.50005 6.68682L4.03164 3.2184C3.80708 2.99385 3.44301 2.99385 3.21846 3.2184C2.99391 3.44295 2.99391 3.80702 3.21846 4.03157L6.68688 7.49999L3.21846 10.9684C2.99391 11.193 2.99391 11.557 3.21846 11.7816C3.44301 12.0061 3.80708 12.0061 4.03164 11.7816L7.50005 8.31316L10.9685 11.7816C11.193 12.0061 11.5571 12.0061 11.7816 11.7816C12.0062 11.557 12.0062 11.193 11.7816 10.9684L8.31322 7.49999L11.7816 4.03157Z" 
                                    fill="currentColor"
                                />
                            </svg>
                        </button>
                    </Dialog.Close>
                </Dialog.Content>
            </Dialog.Portal>
        </Dialog.Root>
    );
};

export default AdminModal;