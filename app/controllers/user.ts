import {Request, Response} from 'express'
import {prisma} from "../prisma";

import {UserService} from "../services/user"
import {UserRepository} from "../repositories/user";

const userService = new UserService(new UserRepository(prisma))
export const getUser = async (req: Request, res: Response) => {
    try {
        const userId = parseInt(req.params.id);
        const user = await userService.getUserById(userId);
        if (user) {
            res.json(user);
        } else {
            res.status(404).json({ message: 'User not found' });
        }
    } catch (error) {
        console.error('Error getting user:', error);
        res.status(500).json({ message: 'Internal server error' });
    }
};