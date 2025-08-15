import React from 'react';
import { createRoot } from 'react-dom/client';

// Admin Components
import UserRoleDropdown from './components/UserRoleDropdown';
import CategoryDropdown from './components/CategoryDropdown';
import AdminModal from './components/AdminModal';
import AdminPostForm from './components/AdminPostForm';

// Initialize React components when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize user role dropdowns
    document.querySelectorAll('[data-user-role-dropdown]').forEach(element => {
        const userId = element.getAttribute('data-user-id');
        const currentRole = element.getAttribute('data-current-role');
        const root = createRoot(element);
        root.render(<UserRoleDropdown userId={userId} currentRole={currentRole} />);
    });

    // Initialize category dropdowns
    document.querySelectorAll('[data-category-dropdown]').forEach(element => {
        const postId = element.getAttribute('data-post-id');
        const currentCategory = element.getAttribute('data-current-category');
        const root = createRoot(element);
        root.render(<CategoryDropdown postId={postId} currentCategory={currentCategory} />);
    });

    // Initialize modals
    document.querySelectorAll('[data-admin-modal]').forEach(element => {
        const modalType = element.getAttribute('data-modal-type');
        const itemId = element.getAttribute('data-item-id');
        const root = createRoot(element);
        root.render(<AdminModal type={modalType} itemId={itemId} />);
    });

    // Initialize post forms
    document.querySelectorAll('[data-admin-post-form]').forEach(element => {
        const formData = JSON.parse(element.getAttribute('data-form-data') || '{}');
        const errors = JSON.parse(element.getAttribute('data-errors') || '{}');
        const categories = JSON.parse(element.getAttribute('data-categories') || '{}');
        const submitUrl = element.getAttribute('data-submit-url');
        const method = element.getAttribute('data-method') || 'POST';
        const submitText = element.getAttribute('data-submit-text') || 'Create Post';
        const cancelUrl = element.getAttribute('data-cancel-url');
        
        const root = createRoot(element);
        root.render(
            <AdminPostForm 
                formData={formData}
                errors={errors}
                categories={categories}
                submitUrl={submitUrl}
                method={method}
                submitText={submitText}
                cancelUrl={cancelUrl}
            />
        );
    });
});