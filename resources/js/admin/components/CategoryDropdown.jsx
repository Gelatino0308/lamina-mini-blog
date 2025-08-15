import React, { useState } from 'react';
import * as Select from '@radix-ui/react-select';

const CategoryDropdown = ({ postId, currentCategory }) => {
    const [category, setCategory] = useState(currentCategory);
    const [isLoading, setIsLoading] = useState(false);

    const categories = {
        'shonen': 'Shonen',
        'shojo': 'Shojo', 
        'seinen': 'Seinen',
        'josei': 'Josei',
        'kodomomuke': 'Kodomomuke'
    };

    const handleCategoryChange = async (newCategory) => {
        if (newCategory === category) return;
        
        setIsLoading(true);
        
        try {
            const response = await fetch(`/admin/posts/${postId}/category`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ category: newCategory })
            });

            if (response.ok) {
                setCategory(newCategory);
            } else {
                throw new Error('Failed to update category');
            }
        } catch (error) {
            console.error('Error updating category:', error);
            alert('Failed to update post category');
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <Select.Root value={category} onValueChange={handleCategoryChange} disabled={isLoading}>
            <Select.Trigger className="inline-flex items-center justify-between px-3 py-1 text-sm bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-500 min-w-[120px]">
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
                        {Object.entries(categories).map(([value, label]) => (
                            <Select.Item 
                                key={value}
                                value={value} 
                                className="flex items-center px-3 py-2 text-sm cursor-pointer hover:bg-gray-100 rounded-sm"
                            >
                                <Select.ItemText>{label}</Select.ItemText>
                            </Select.Item>
                        ))}
                    </Select.Viewport>
                </Select.Content>
            </Select.Portal>
        </Select.Root>
    );
};

export default CategoryDropdown;