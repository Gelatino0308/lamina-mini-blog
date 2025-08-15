import React from 'react';
import * as Form from '@radix-ui/react-form';
import * as Label from '@radix-ui/react-label';

const AdminPostForm = ({ 
    formData = {}, 
    errors = {}, 
    categories = {}, 
    submitUrl, 
    method = 'POST', 
    submitText = 'Create Post',
    cancelUrl 
}) => {
    const handleSubmit = (event) => {
        event.preventDefault();
        const formData = new FormData(event.currentTarget);
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (csrfToken) {
            formData.append('_token', csrfToken);
        }
        
        if (method !== 'POST') {
            formData.append('_method', method);
        }
        
        fetch(submitUrl, {
            method: 'POST',
            body: formData
        }).then(response => {
            if (response.ok) {
                window.location.href = cancelUrl;
            } else {
                console.error('Form submission failed');
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    };

    return (
        <Form.Root className="space-y-6" onSubmit={handleSubmit}>
            {/* Post Title */}
            <Form.Field name="title">
                <div className="flex items-baseline justify-between">
                    <Form.Label className="block text-sm font-medium text-gray-700 mb-2">
                        Post Title
                    </Form.Label>
                    <Form.Message className="text-xs text-red-600" match="valueMissing">
                        Please enter a post title
                    </Form.Message>
                    <Form.Message className="text-xs text-red-600" match="tooLong">
                        Title is too long
                    </Form.Message>
                </div>
                <Form.Control asChild>
                    <input
                        type="text"
                        name="title"
                        defaultValue={formData.title || ''}
                        placeholder="Enter your post title..."
                        required
                        maxLength={255}
                        className={`w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 ${
                            errors.title ? 'border-red-500' : ''
                        }`}
                    />
                </Form.Control>
                {errors.title && (
                    <p className="mt-1 text-sm text-red-600">{errors.title}</p>
                )}
            </Form.Field>

            {/* Category */}
            <Form.Field name="category">
                <div className="flex items-baseline justify-between">
                    <Form.Label className="block text-sm font-medium text-gray-700 mb-2">
                        Genre
                    </Form.Label>
                    <Form.Message className="text-xs text-red-600" match="valueMissing">
                        Please select a genre
                    </Form.Message>
                </div>
                <Form.Control asChild>
                    <select
                        name="category"
                        defaultValue={formData.category || ''}
                        required
                        className={`w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 ${
                            errors.category ? 'border-red-500' : ''
                        }`}
                    >
                        <option value="">Select anime/manga genre</option>
                        {Object.entries(categories).map(([value, label]) => (
                            <option key={value} value={value}>
                                {label}
                            </option>
                        ))}
                    </select>
                </Form.Control>
                {errors.category && (
                    <p className="mt-1 text-sm text-red-600">{errors.category}</p>
                )}
            </Form.Field>

            {/* Post Body */}
            <Form.Field name="body">
                <div className="flex items-baseline justify-between">
                    <Form.Label className="block text-sm font-medium text-gray-700 mb-2">
                        Content
                    </Form.Label>
                    <Form.Message className="text-xs text-red-600" match="valueMissing">
                        Please enter post content
                    </Form.Message>
                </div>
                <Form.Control asChild>
                    <textarea
                        name="body"
                        rows={10}
                        defaultValue={formData.body || ''}
                        placeholder="Write your post content..."
                        required
                        className={`w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 resize-vertical ${
                            errors.body ? 'border-red-500' : ''
                        }`}
                    />
                </Form.Control>
                {errors.body && (
                    <p className="mt-1 text-sm text-red-600">{errors.body}</p>
                )}
            </Form.Field>

            {/* Cover Image */}
            <Form.Field name="image">
                <Form.Label className="block text-sm font-medium text-gray-700 mb-2">
                    Cover Image
                </Form.Label>
                <Form.Control asChild>
                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                    />
                </Form.Control>
                <p className="mt-1 text-sm text-gray-500">
                    Supported formats: WEBP, PNG, JPG (Max: 3MB)
                </p>
                {errors.image && (
                    <p className="mt-1 text-sm text-red-600">{errors.image}</p>
                )}
            </Form.Field>

            {/* Submit Buttons */}
            <div className="flex items-center justify-between pt-4">
                <Form.Submit asChild>
                    <button 
                        type="submit"
                        className="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                    >
                        {submitText}
                    </button>
                </Form.Submit>
                
                <a 
                    href={cancelUrl}
                    className="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                >
                    Cancel
                </a>
            </div>
        </Form.Root>
    );
};

export default AdminPostForm;