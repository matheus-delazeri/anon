import { Request, Response } from "express";
import { prisma } from "../prisma";

import { GroupRepository } from "../repositories/group";
import { GroupService } from "../services/group";

const groupService = new GroupService(new GroupRepository(prisma));

export const getGroupById = async (req: Request, res: Response) => {
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

export const getGroupByName = async (req: Request, res: Response) => {
    try {
        const groupName = req.params.name;
        const group = await groupService.getGroupByName(groupName);

        if (group){
            res.json(group);
        }else{
            res.status(404).json({message: 'Group not found'});
        }
    } catch (error) {
        console.error('Error getting group: ', error);
        res.status(500).json({ message: 'Internal server error' });
    }
}

export const createGroup = async (req: Request, res: Response) => {
    try{
        const adminId = parseInt(req.body.adminId);
        const groupName = req.body.name;

        const group = await groupService.createGroup(adminId, groupName);
        
        if (group){
            res.json(group);
        } else{
            res.status(400).json({message: 'Could not create the group'});
        }
    } catch (error) {
        console.error('Error creating group: ', error);
        res.status(500).json({ message: 'Internal server error' });
    }
}

export const updateGroup = async (req: Request, res: Response) => {
    try{
        const groupId = parseInt(req.params.id);
        const adminId = parseInt(req.body.adminId);
        const groupName = req.body.groupName;
        var moderatorId: number | null = parseInt(req.body.moderatorId);

        const group = await groupService.updateGroup(adminId, groupId, groupName, moderatorId);

        if (group){
            res.json(group);
        } else{
            res.status(400).json({message: 'Could not update the group'});
        }
    } catch (error) {
        console.error('Error updating group: ', error);
        res.status(500).json({ message: 'Internal server error' });
    }
}

export const deleteGroup = async (req: Request, res: Response) => {
    try{
        const groupId = parseInt(req.params.id);
        const adminId = parseInt(req.body.adminId);

        if (!(isNaN(adminId) || isNaN(groupId))){
            throw new Error("Some id's are not numbers!");
        }

        if (await groupService.deleteGroup(adminId, groupId)){
            res.json({status: true, message: 'Group succesfully deleted'});
        }
        else{
            res.status(400).json({message: 'Could not delete the group'});
        }
    }catch (error){
        console.error("Error deleting group: ", error);
        res.status(500).json({ message: 'Internal server error' });
    }
}