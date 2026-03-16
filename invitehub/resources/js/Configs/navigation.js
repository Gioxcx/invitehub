export function getNavigation(isAdmin) {
    const items = [
        {
            label: "Dashboard",
            route: "dashboard",
            active: "dashboard",
        },
    ];

    if (isAdmin) {
        items.push({
            label: "Usuários",
            route: "admin.invites.index",
            active: "admin.invites.*",
        });
    }

    return items;
}
