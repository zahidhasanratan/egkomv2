<style>
    .dashboard-container {
        min-height: 80vh;
        padding: 40px 20px;
        background-color: #f5f5f5;
    }
    
    .dashboard-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        gap: 30px;
    }
    
    /* Sidebar Styles */
    .dashboard-sidebar {
        width: 280px;
        background: white;
        border-radius: 16px;
        padding: 30px 0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        height: fit-content;
        position: sticky;
        top: 20px;
    }
    
    .sidebar-header {
        padding: 0 30px 20px;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
    }
    
    .sidebar-title {
        color: #6B46C1;
        font-size: 22px;
        font-weight: 600;
        margin: 0;
    }
    
    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-menu li {
        margin: 0;
    }
    
    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 30px;
        color: #333;
        text-decoration: none;
        font-size: 15px;
        transition: all 0.3s;
        border-left: 3px solid transparent;
    }
    
    .sidebar-menu a:hover {
        background-color: #f9f9f9;
        color: #6B46C1;
        border-left-color: #6B46C1;
    }
    
    .sidebar-menu a.active {
        background-color: #f0f0ff;
        color: #6B46C1;
        border-left-color: #6B46C1;
        font-weight: 500;
    }
    
    .sidebar-menu a i {
        width: 20px;
        text-align: center;
        font-size: 18px;
    }
    
    /* Main Content Styles */
    .dashboard-content {
        flex: 1;
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    .dashboard-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }
    
    .dashboard-title {
        color: #333;
        font-size: 28px;
        font-weight: 600;
        margin: 0 0 10px 0;
    }
    
    .dashboard-subtitle {
        color: #666;
        font-size: 14px;
        margin: 0;
    }
    
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        padding: 25px;
        color: white;
    }
    
    .stat-card.primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .stat-card.success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    
    .stat-card.warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .stat-card.info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .stat-value {
        font-size: 32px;
        font-weight: 700;
        margin: 0 0 5px 0;
    }
    
    .stat-label {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state-icon {
        font-size: 64px;
        color: #ddd;
        margin-bottom: 20px;
    }
    
    .empty-state-title {
        font-size: 20px;
        color: #666;
        margin-bottom: 10px;
    }
    
    .empty-state-text {
        font-size: 14px;
        color: #999;
    }
    
    @media (max-width: 768px) {
        .dashboard-wrapper {
            flex-direction: column;
        }
        
        .dashboard-sidebar {
            width: 100%;
            position: relative;
            top: 0;
        }
        
        .dashboard-stats {
            grid-template-columns: 1fr;
        }
    }
</style>

