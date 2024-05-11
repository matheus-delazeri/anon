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

export const getGroupsOfUser = async (req: Request, res: Response) => {
    try {
        const userId = parseInt(req.params.userId);
        const groups = await userGroupService.getGroupsOfUser(userId);

        if (groups){
            res.json(groups);
        }else{
            res.status(404).json({message: 'User not found in any group'});
        }
    } catch (error) {
        console.error('Error getting groups of user: ', error);
        res.status(500).json({ message: 'Internal server error' });
    }
}

export const getUsersFromGroup = async (req: Request, res: Response) => {
    try {
        const groupId = parseInt(req.params.groupId);
        const users = await userGroupService.getUsersFromGroup(groupId);

        if (users){
            res.json(users);
        }else{
            res.status(404).json({message: 'No users found in this group'});
        }
    } catch (error) {
        console.error('Error getting users from group: ', error);
        res.status(500).json({ message: 'Internal server error' });
    }
}

export const addUserToGroup = async (req: Request, res: Response) => {
    try{
        const requesterId = parseInt(req.body.requesterId);
        const userId = parseInt(req.body.userId);
        const groupId = parseInt(req.body.groupId);
        const role = req.body.role;

        const userGroup = await userGroupService.addUserToGroup(requesterId, userId, groupId, role);
        
        if (userGroup){
            res.json(userGroup);
        } else{
            res.status(400).json({message: 'Could not add user to the group'});
        }
    } catch (error) {
        console.error('Error adding user to group: ', error);
        res.status(500).json({ message: 'Internal server error' });
    }
}

export const updateRole = async (req: Request, res: Response) => {
    try{
        const requesterId = parseInt(req.body.requesterId);
        const userId = parseInt(req.body.userId);
        const groupId = parseInt(req.body.groupId);
        const role = req.body.role;

        const userGroup = await userGroupService.updateRole(requesterId, userId, groupId, role);
        
        if (userGroup){
            res.json(userGroup);
        } else{
            res.status(400).json({message: 'Could not update role'});
        }
    } catch (error) {
        console.error('Error updating role: ', error);
        res.status(500).json({ message: 'Internal server error' });
    }
}

export const deleteUserFromGroup = async (req: Request, res: Response) => {
    try{
        const requesterId = parseInt(req.body.requesterId);
        const userId = parseInt(req.body.userId);
        const groupId = parseInt(req.body.groupId);

        const deleted = await userGroupService.deleteUserFromGroup(requesterId, userId, groupId);
        
        if (deleted){
            res.json({message: 'User deleted from group'});
        } else{
            res.status(400).json({message: 'Could not delete user from group'});
        }
    } catch (error) {
        console.error('Error deleting user from group: ', error);
        res.status(500).json({ message: 'Internal server error' });
    }
}

