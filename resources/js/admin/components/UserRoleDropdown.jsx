import React, { useState } from 'react';
import * as Select from '@radix-ui/react-select';

const UserRoleDropdown = ({ userId, currentRole }) => {
    const [role, setRole] = useState(currentRole);
    const [isLoading, setIsLoading] = useState(false);

    const handleRoleChange = async (newRole) => {
        if (newRole === role) return;
        
        setIsLoading(true);
        
        try {
            const response = await fetch(`/admin/users/${userId}/role`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ role: newRole })
            });

            if (response.ok) {
                setRole(newRole);
            } else {
                throw new Error('Failed to update role');
            }
        } catch (error) {
            console.error('Error updating role:', error);
            alert('Failed to update user role');
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <Select.Root value={role} onValueChange={handleRoleChange} disabled={isLoading}>
            <Select.Trigger className="inline-flex items-center justify-between px-3 py-1 text-sm bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-500 min-w-[100px]">
                <Select.Value />
                <Select.Icon className="ml-2">
                    <svg width="12" height="12" viewBox="0 0 15 15" fill="none">
                        <path d="M4.5 6l3 3 3-3" stroke="currentColor" strokeWidth="1.5" />
                    </svg>
                </Select.Icon>
            </Select.Trigger>

            <Select.Portal>
                <Select.Content className="bg-white border border-gray-300 rounded-md shadow-lg z-50">
                    <Select.Viewport className="p-1">
                        <Select.Item 
                            value="blogger" 
                            className="flex items-center px-3 py-2 text-sm cursor-pointer hover:bg-gray-100 rounded-sm"
                        >
                            <Select.ItemText>Blogger</Select.ItemText>
                        </Select.Item>
                        <Select.Item 
                            value="admin" 
                            className="flex items-center px-3 py-2 text-sm cursor-pointer hover:bg-gray-100 rounded-sm"
                        >
                            <Select.ItemText>Admin</Select.ItemText>
                        </Select.Item>
                    </Select.Viewport>
                </Select.Content>
            </Select.Portal>
        </Select.Root>
    );
};

export default UserRoleDropdown;