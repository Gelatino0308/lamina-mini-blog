import React from 'react';
import { createRoot } from 'react-dom/client';

// Admin Components
import AdminSidebar from './components/AdminSidebar';
import UserRoleDropdown from './components/UserRoleDropdown';
import CategoryDropdown from './components/CategoryDropdown';
import AdminModal from './components/AdminModal';

// Initialize React components when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize sidebar if element exists
    const sidebarElement = document.getElementById('admin-sidebar');
    console.log('Sidebar element:', sidebarElement);
    if (sidebarElement) {
        const root = createRoot(sidebarElement);
        root.render(<AdminSidebar />);
    }

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
});