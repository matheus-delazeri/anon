import { Request, Response } from "express";
import { prisma } from "../prisma";

import { GroupRepository } from "../repositories/group";
import { GroupService } from "../services/group";

const groupService = new GroupService(new GroupRepository(prisma));
export const getGroup = async (req: Request, res: Response) => {
    try {
        const groupId = parseInt(req.params.id);
        const group = await groupService.getGroupById(groupId);

        if (group){
            res.json(group);
        }else{
            res.status(404).json({message: 'Group not found'});
        }
    } catch (error) {
        console.error('Error getting group: ', error);
        res.status(500).json({ message: 'Internal server error' });
    }
};