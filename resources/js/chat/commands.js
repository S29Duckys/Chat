import { appendSystem } from './ui.js';
import { sendRaw }      from './socket.js';

export function buildCommands(myId, receiverId, csrfToken) {

    function getNick() {
        return localStorage.getItem('chat_nick') || myId.slice(0, 8);
    }

    return {
        help: {
            description: 'Affiche la liste des commandes',
            execute(_, commands) {
                const list = Object.entries(commands)
                    .map(([name, cmd]) => `/${name} — ${cmd.description}`)
                    .join('\n');
                appendSystem(list);
            }
        },

        clear: {
            description: 'Vide l\'historique affiché',
            execute() {
                document.getElementById('messages').innerHTML = '';
            }
        },

        nick: {
            description: '/nick [pseudo] — Change ton pseudo affiché',
            execute(args) {
                const pseudo = args.join(' ').trim();
                if (!pseudo) return appendSystem('Usage : /nick MonPseudo');
                localStorage.setItem('chat_nick', pseudo);
                appendSystem(`Pseudo changé en "${pseudo}"`);
            }
        },

        me: {
            description: '/me [action] — Envoie une action',
            async execute(args) {
                const action = args.join(' ').trim();
                if (!action) return appendSystem('Usage : /me danse');
                await sendRaw(`* ${getNick()} ${action}`, receiverId, csrfToken);
            }
        },

        whoami: {
            description: 'Affiche ton ID de session',
            execute() {
                appendSystem(`Ton ID : ${myId}`);
            }
        },
    };
}

export function parseCommand(raw) {
    const parts = raw.slice(1).split(' ');
    return {
        name: parts[0].toLowerCase(),
        args: parts.slice(1),
    };
}