import React from 'react';

const AdminSidebar = () => {
    const currentPath = window.location.pathname;
    
    const navItems = [
        { path: '/admin/dashboard', label: 'Dashboard', icon: '📊' },
        { path: '/admin/users', label: 'Users', icon: '👥' },
        { path: '/admin/posts', label: 'Posts', icon: '📝' },
        { path: '/admin/comments', label: 'Comments', icon: '💬' }
    ];

    const isActive = (path) => currentPath === path;

    const handleLogout = async () => {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/logout';
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (csrfToken) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
        }
        
        document.body.appendChild(form);
        form.submit();
    };

    return (
        <div className="h-screen w-64 bg-slate-800 text-white flex flex-col">
            {/* Header */}
            <div className="p-6 border-b border-slate-700">
                <h1 className="text-xl font-bold text-orange-300">WeebYaps</h1>
                <p className="text-sm text-slate-300">Admin Dashboard</p>
            </div>

            {/* Navigation */}
            <nav className="flex-1 p-4">
                <ul className="space-y-2">
                    {navItems.map((item) => (
                        <li key={item.path}>
                            <a
                                href={item.path}
                                className={`flex items-center gap-3 px-4 py-3 rounded-lg transition-colors ${
                                    isActive(item.path)
                                        ? 'bg-orange-600 text-white'
                                        : 'text-slate-300 hover:bg-slate-700 hover:text-white'
                                }`}
                            >
                                <span className="text-lg">{item.icon}</span>
                                {item.label}
                            </a>
                        </li>
                    ))}
                </ul>
            </nav>

            {/* Logout */}
            <div className="p-4 border-t border-slate-700">
                <button
                    onClick={handleLogout}
                    className="w-full flex items-center gap-3 px-4 py-3 text-slate-300 hover:bg-slate-700 hover:text-white rounded-lg transition-colors"
                >
                    <span className="text-lg">🚪</span>
                    Logout
                </button>
            </div>
        </div>
    );
};

export default AdminSidebar;