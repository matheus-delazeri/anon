import { Request, Response } from "express";
import { prisma } from "../prisma";

import { UserGroupService } from "../services/userGroup";

const userGroupService = new UserGroupService(prisma);

export const getRole = async (req: Request, res: Response) => {
    try {
        const userId = parseInt(req.params.userId);
        const groupId = parseInt(req.params.groupId);

        const userGroup = await userGroupService.getUserGroup(userId, groupId);
        
        if (userGroup){
            res.json(userGroup);
        }else{
            res.status(404).json({message: 'User not found in this group'});
        }
    } catch (error) {
        console.error('Error getting role: ', error);
        res.status(500).json({ message: 'Internal server error' });
    }
};



